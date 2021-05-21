<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;

use common\models\RoleMenu;
use yii\helpers\ArrayHelper;

/**
 * 角色菜单
 * Class RoleMenuService
 * @package App\Services
 */
class RoleMenuService
{
    /**
     * 更新授权信息
     * @param $role_id
     * @param $treeId
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function update($role_id,$treeId){
        if(!$role_id) return false;

        RoleMenu::deleteAll(['role_id'=>$role_id]);
        if(empty($treeId)) return true;
        if(!is_array($treeId)){
            $treeId=explode(',',$treeId);
        }
        $treeId=array_unique($treeId);
        $fieldArr=['role_id','menu_id'];
        $data=[];
        foreach ($treeId as $menu_id){
            if($menu_id){
                $data[]=[$role_id,$menu_id];
            }
        }
        (new RoleMenu())->insertAll($fieldArr,$data);
        return true;
    }

    /**
     * 获取角色分组的菜单权限ID
     * @param $roleId
     * @return array
     */
    public static function getRoleMenuList($roleId){
        $list=[];
        if($roleId){
            $list=RoleMenu::find()->where(['role_id'=>$roleId])->asArray()->all();
            $list = array_unique(ArrayHelper::getColumn($list,'menu_id'));
        }
        return $list?:[];
    }
}
