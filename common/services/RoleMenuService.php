<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;


use common\models\RoleMenu;

/**
 * 角色菜单
 * Class RoleMenuService
 * @package App\Services
 */
class RoleMenuService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->model = new  RoleMenu();
        $this->validate = $loadValidate;
    }


    /**
     * 更新授权信息
     * @param $role_id
     * @param $treeId
     * @return bool
     */
    public function update($role_id,$treeId){
        if(!$role_id) return false;

        $this->model->drop($role_id,'role_id');
        if(empty($treeId)) return true;
        if(!is_array($treeId)){
            $treeId=explode(',',$treeId);
        }
        $treeId=array_unique($treeId);
        $fieldArr=['role_id','menu_id'];
        $data=[];
        $this->insertAll($fieldArr,$data);
        foreach ($treeId as $menu_id){
            if($menu_id){
                $data[]=[$role_id,$menu_id];
            }
        }
        $this->insertAll($fieldArr,$data);
        return true;
    }

    /**
     * 获取角色分组的菜单权限ID
     * @param $roleId
     * @return array
     */
    public function getRoleMenuList($roleId){
        $map=[];
        $list=[];
        if($roleId){
            if(!is_array($roleId)){
                $roleId=explode(',',$roleId);
            }
            $roleId=array_unique($roleId);
            $map[]=['role_id' => $roleId[0]];
            $list=$this->getAll($map,[],[],'menu_id,menu_id',[['menu_id','asc']]);
        }
        return $list?:[];
    }
}
