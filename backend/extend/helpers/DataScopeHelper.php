<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\extend\helpers;

use common\services\system\RoleStructService;
use common\services\system\StructService;

class DataScopeHelper
{
    //数据权限类型
    public static function typeList($type = null)
    {
        $list = [
            1 => '全部数据权限',
            2 => '本部门及以下数据权限',
            4 => '本部门数据权限',
            8 => '自定数据权限',
            16 => '仅本人数据权限'
        ];
        return is_null($type) ? $list : ($list[$type] ?? '--');
    }


    /**
     * 拼接数据权限条件
     * 表中必须含有存储用户的组织id，存储用户的id， 默认组织字段位struct_id，用户id位user_id
     *
     * $model = xxx::find()->where(['xxxx'=>xxx]);
     * $model = (new Query())->from('xxx')
     * $list = DataScopeAuth::dataScope($model)->all();
     *
     * @param $model
     * @param string $structField 组织架构字段名
     * @param string $userField 用户字段名
     * @param string $structAlias 关联查询时 表的别名
     * @param string $userAlias 关联查询时的表别名
     * @return mixed
     */
    public static function queryDataScope($model, string $structField = 'struct_id', string $userField = 'user_id', string $structAlias = '', string $userAlias = '')
    {
        $filter = self::getFilterStructList();
        if($filter === true) return $model;//超管
        if($filter === false) return $model->andWhere('1=0');//无任何
        if(!$structField && !$userField) return $model->andWhere('1=0');

        $structList = [];
        $userId = false;
        if(is_array($filter)){
            $structList = $filter['struct'] ?? [];
            $userId = $filter['user'] ?? false;
        }
        if(!$structList && !$userId)  return $model->andWhere('1=0');

        $structField = $structField?(($structAlias ? $structAlias . '.' : '') . $structField):'';
        $userField = $userField?(($userAlias ? $userAlias . '.' : '') . $userField):'';
        if($structField && $userField){
            if ($structList && $userId) {
                $model = $model->andWhere(['or', [$userField => $userId], [$structField => $structList]]);
            } elseif ($structList) {
                $model = $model->andWhere([$structField => $structList]);
            } elseif ($userId) {
                $model = $model->andWhere([$userField => $userId]);
            }
        }elseif ($structField){
            $model = $model->andWhere([$structField => $structList]);
        }elseif ($userId){
            $model = $model->andWhere([$userField => $userId]);
        }
        return $model;
    }


    /**
     * /**
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
     */
    public static function arrayDataScope(array $list = [], string $structField = 'struct_id', string $userField = 'user_id'): array
    {
        if (empty($list)) return [];
        $filter = self::getFilterStructList();
        if($filter === true) return $list;//超管
        if($filter === false) return [];//无任何
        if(!$structField && !$userField) return [];//未定义字段 无任何

        $structList = [];
        $userId = false;
        if(is_array($filter)){
            $structList = $filter['struct'] ?? [];
            $userId = $filter['user'] ?? false;
        }
        if(!$structList && !$userId) return [];

        foreach ($list as $key => $value) {
            $struct_id = $value[$structField] ?? 0;
            $user_id =$value[$userField] ?? 0;

            if($structField && $userField){
                if ($structList && $userId) {
                    if (!in_array($struct_id, $structList) && ($user_id != $userId)) {
                        unset($list[$key]);
                    }
                } elseif ($structList) {
                    if (!in_array($struct_id, $structList)) {
                        unset($list[$key]);
                    }
                } elseif ($userId) {
                    if ($user_id != $userId) {
                        unset($list[$key]);
                    }
                }
            }elseif ($structField){
                if (!in_array($struct_id, $structList)) {
                    unset($list[$key]);
                }
            }elseif ($userField){
                if ($userId && $user_id != $userId) {
                    unset($list[$key]);
                }
            }

        }
        return $list;
    }

    /**
     * 对组织架构进行数据权限过滤
     * 主要是将过滤后的根部门的parent_id改为0，为了树形显示
     * @param array $structList
     * @param string $id_field
     * @param string $parent_field
     * @return array
     */
    public static function structFilter(array $structList,string $id_field = 'id',string $parent_field='parent_id'):array{
        if (empty($structList)) return [];
        $filter = self::getFilterStructList();

        if($filter === true) return $structList;//超管直接返回
        if($filter === false) return [];//无任何

        $structAuthList = [];
        if(is_array($filter)){
            $structAuthList = $filter['struct']??[];
        }
        if(empty($structAuthList)) return [];
        $idList = [];
        foreach ($structList as $key=>$value){
            if(in_array($value[$id_field],$structAuthList)){
                $idList[] = $value[$id_field];
            }else{
                unset($structList[$key]);
            }
        }
        if(empty($structList)) return [];
        foreach ($structList as $key=>$value){
            if(!in_array($value[$parent_field],$idList)) {
                $value[$parent_field] = 0;
                $structList[$key] = $value;
            }
        }
        return array_values($structList);
    }

    /**
     * 获取数据权限过滤用户的组织id数组
     * 超管返回ture 所有数据；
     * 没有权限组织或角色返回false，没有任何数据
     * struct 权限组织id列表
     * user 返回false不判断 否则判断
     * @return array|bool
     */
    private static function getFilterStructList()
    {
        $adminId = intval(LoginAuthHelper::adminLoginInfo('info.id'));
        if (!$adminId) return false; //未登录返回无权限

        $isAdmin = intval(LoginAuthHelper::adminLoginInfo('info.is_admin'));
        if ($isAdmin) return true; //超管返回全部权限

        $dataScope = LoginAuthHelper::adminLoginInfo('dataScope');//用户角色列表
        if ($dataScope < 1) return false;

        if (!(31 & $dataScope)) return false;//无效的键值

        $structList = LoginAuthHelper::adminLoginInfo('struct');//用户组织架构
        if (empty($structList)) return false;//无组织 返回无权限

        $roleList = LoginAuthHelper::adminLoginInfo('role');
        if (empty($roleList)) return false; //无角色返回无权限

        $structArr = [];//组织id列表
        $isUser = false;//是否含有本人数据

        //全部数据权限
        if (1 & $dataScope) return true;

        ///本部门及以下数据权限
        if (2 & $dataScope) {
            foreach ($structList as $value) {
                array_push($structArr, $value['id']);
                $childList = StructService::getChildList($value['id'], true);
                if ($childList) {
                    //[...$structArr,...$childList];
                    $structArr = array_merge($structArr, $childList);
                }
            }
        }
        if (4 & $dataScope) {//本部门数据权限
            foreach ($structList as $value) {
                array_push($structArr, $value['id']);
            }
        }
        if (8 & $dataScope) {//自定义
            $struct = RoleStructService::getRoleStructList($roleList);
            if ($struct) {
                //[...$structArr,...$struct];
                $structArr = array_merge($structArr, $struct);
            }
        }
        if (16 == $dataScope) {//个人数据 优先级最低
            $isUser = true;
        }
        $structArr = array_unique($structArr);
        return ['struct' => $structArr, 'user' => $isUser ? $adminId : false];
    }

}