<?php
namespace backend\helpers;


use common\models\RoleStruct;
use common\services\StructService;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use Yii;

class DataScopeAuth
{
    //数据权限类型
    public static function typeList($type = null){
        $list = [
            1=>'全部数据权限',
            2=>'本部门及以下数据权限',
            3=>'本部门数据权限',
            4=>'自定数据权限',
            5=>'仅本人数据权限'
        ];
        return is_null($type)?$list:($list[$type]??'--');
    }

    /**
     * 拼接数据权限条件
     * 表中必须含有存储用户的组织id，存储用户的id， 默认组织字段位struct_id，用户id位user_id
     *
     * $model = xxx::find()->where(['xxxx'=>xxx]);
     * $list = DataScopeAuth::dataScope($model)->all();
     *
     * @param ActiveQuery $model model::find对象
     * @param string $structField 组织架构字段名
     * @param string $userField 用户字段名
     * @param string $structAlias 关联查询时 表的别名
     * @param string $userAlias 关联查询时的表别名
     * @return ActiveQuery
     * @throws \Exception
     */
    public static function queryDataScope(ActiveQuery $model,string $structField='struct_id',string $userField='user_id',string $structAlias='',string $userAlias='')
    {
        $filter = self::getFilterStructList();
        if ($filter === false){
            $model->andWhere('1=0');
        }elseif (is_array($filter)){
            $structField = ($structAlias?$structAlias.'.':'').$structField;
            $userField = ($userAlias?$userAlias.'.':'').$userField;

            $structList = $filter['struct']??[];
            $userId = $filter['user']??false;
            if($structList && $userId){
                $model->andWhere(['or',[$userField=>$userId],[$structField=>$structList]]);
            }elseif ($structList){
                $model->andWhere([$structField=>$structList]);
            }elseif ($userId){
                $model->andWhere([$userField=>$userId]);
            }
        }
        return $model;
    }

    /**
     * 列表进行数据过滤
     * 数组
     * $list = [
     *      ['struct_id'=>xx,'user_id'=>xx, ...],
     *      ['struct_id'=>xx,'user_id'=>xx, ...],
     * ]
     *
     * @param array $list
     * @param string $structField 组织字段
     * @param string $userField 用户字段 可以为空 只检查组织
     * @return array
     * @throws \Exception
     */
    public static function arrayDataScope(array $list=[],string $structField='struct_id',string $userField='user_id'){
        if(empty($list)) return [];
        $filter = self::getFilterStructList();
        if ($filter === false){
            return [];
        }elseif (is_array($filter)){
            $structList = $filter['struct']??[];
            $userId = $filter['user']??false;

            foreach ($list as $key=>$value){
                $struct_id = $value[$structField]??0;
                $user_id = $value[$userField]??0;
                if($structList && $userId){
                    if(!in_array($struct_id,$structList) && ($userField && $user_id != $userId)){
                        unset($list[$key]);
                    }
                }elseif ($structList){
                    if(!in_array($struct_id,$structList)){
                        unset($list[$key]);
                    }
                }elseif ($userId){
                    if($user_id != $userId){
                        unset($list[$key]);
                    }
                }
            }
        }
        return $list;
    }

    /**
     * 获取数据权限过滤用户的组织id数组
     * 超管返回ture 所有数据；没有权限组织或角色返回false，没有任何数据
     * @return array|bool
     * @throws \Exception
     */
    private static function getFilterStructList(){
        $userId = CommonBack::adminLoginInfo('info.id');
        if(!$userId) return false; //未登录返回无权限
        if ($userId == 1) return true; //超管返回全部权限

        $roleList = CommonBack::adminLoginInfo('role');//用户角色列表
        if(!$roleList) return false; //无角色 返回无权限
        ArrayHelper::multisort($roleList,'data_scope');

        $structList = CommonBack::adminLoginInfo('struct');//用户组织架构
        if(empty($structList)) return false;//无组织 返回无权限

        $structArr = [];//组织id列表
        $isUser = false;//是否含有本人数据

        $scopeList = self::typeList();
        foreach ($roleList as $roleInfo){
            if($roleInfo['id']==1){//超管全部
                return true;
            }
            $dataScope = $roleInfo['data_scope'];
            if(!array_key_exists($dataScope,$scopeList)){
                continue;
            }

            if ($dataScope == 1){//全部权限
                return true;
            } elseif ($dataScope == 2){//本部门及以下数据权限
                foreach ($structList as $value){
                    array_push($structArr,$value['id']);
                    $childList = StructService::getChildList($value['id'],true);
                    if($childList){
                        $structArr = [...$structArr,...$childList];
                    }
                }
            } elseif ($dataScope == 3){//本部门
                foreach ($structList as $value){
                    array_push($structArr,$value['id']);
                }
            } elseif ($dataScope == 4){//自定义
                $struct = RoleStruct::find()->where(['role_id'=>$roleInfo['id']])->asArray()->all();
                if($struct){
                    $struct = ArrayHelper::getColumn($struct,'struct_id');
                    if($struct){
                        $structArr = [...$structArr,...$struct];
                    }
                }
            } elseif ($dataScope == 5){//个人数据
                $isUser = true;
            }
        }
        $structArr = array_unique($structArr);
        if(empty($structArr)) return false;
        return ['struct'=>$structArr,'user'=>$isUser?$userId:false];
    }
}