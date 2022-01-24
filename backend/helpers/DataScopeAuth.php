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
     * 表中必须使用 struct_id存储用户的组织id，user_id存储用户的id
     *
     * $model = xxx::find()->where(['xxxx'=>xxx]);
     * $list = DataScopeAuth::dataScope($model)->all();
     *
     * @param ActiveQuery $model model::find对象
     * @param string $structAlias 关联查询时 表的别名
     * @param string $userAlias 关联查询时的表别名
     * @return ActiveQuery
     * @throws \Exception
     */
    public static function dataScope(ActiveQuery $model,string $structAlias='',string $userAlias='')
    {
        $filter = self::dataScopeFilter('','');
        if ($filter === false){
            $model->andWhere('1=0');
        }elseif (is_array($filter)){
            $model->andWhere($filter);
        }
        return $model;
    }

    /**
     * 数据范围过滤
     * 超管返回ture 所有数据；没有权限组织或角色返回false，没有任何数据
     * @param string $structAlias
     * @param string $userAlias
     * @return array|bool
     * @throws \Exception
     */
    private static function dataScopeFilter(string $structAlias='',string $userAlias=''){
        if(Yii::$app->user->isGuest) return false;
        $userId = Yii::$app->user->getId();
        if ($userId == 1) return true;
        $structList = CommonBack::adminLoginInfo('struct');
        $roleList = CommonBack::adminLoginInfo('role.list');

        if(!$roleList || count($roleList)<1) return false;
        ArrayHelper::multisort($roleList,'data_scope');

        $isAll = false;//是否未全部数据
        $structArr = [];//不是全部数据时的组织列表
        $isUser = false;//是否含有本人数据
        $scopeList = self::typeList();
        foreach ($roleList as $roleInfo){
            if($isAll) break;
            if($roleInfo['id']==1){//超管全部
                $isAll = true;
                break;
            }
            $dataScope = $roleInfo['data_scope'];
            if(!array_key_exists($dataScope,$scopeList)){
                continue;
            }
            if ($dataScope == 1){//全部权限
                $isAll = true;
                break;
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

        if($isAll) return true;
        $structArr = array_unique($structArr);
        $userKey = $userAlias?$userAlias.'.user_id':'user_id';
        $structKey = $structAlias?$structAlias.'.struct_id':'struct_id';
        if(empty($structArr)){
            if(!$isUser){
                return false;
            }else{
                return [$userKey=>$userId];
            }
        }else{
            if($isUser){
                return ['or',[$userKey=>$userId],[$structKey=>$structArr]];
            }else{
                return [$structKey=>$structArr];
            }
        }
    }
}