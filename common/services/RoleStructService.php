<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;

use common\models\RoleMenu;
use common\models\RoleStruct;
use yii\helpers\ArrayHelper;

/**
 * 角色部门
 * Class RoleStructService
 * @package App\Services
 */
class RoleStructService
{
    /**
     * 更新授权信息
     * @param $role_id
     * @param $struct_id
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function update($role_id,$struct_id){
        if(!$role_id) return false;

        RoleStruct::deleteAll(['role_id'=>$role_id]);
        if(empty($struct_id)) return true;
        if(!is_array($struct_id)){
            $structIdArr=explode(',',$struct_id);
        }
        $structIdArr=array_unique($structIdArr);
        $fieldArr=['role_id','struct_id'];
        $data=[];
        foreach ($structIdArr as $struct_id){
            if($struct_id){
                $data[]=[$role_id,$struct_id];
            }
        }
        (new RoleStruct())->insertAll($fieldArr,$data);
        return true;
    }

    /**
     * 获取角色分组的菜单权限ID
     * @param $roleId
     * @return array
     */
    public static function getRoleStructList($roleId){
        $list=[];
        if($roleId){
            $list=RoleStruct::find()->where(['role_id'=>$roleId])->asArray()->all();
            $list = array_unique(ArrayHelper::getColumn($list,'struct_id'));
        }
        return $list?:[];
    }
}
