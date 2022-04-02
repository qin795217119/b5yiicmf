<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace backend\modules\system\controllers;


use backend\extend\BaseController;
use backend\extend\traits\CommonAction;
use common\services\system\AdminRoleService;
use common\services\system\AdminStructService;
use common\services\system\RoleService;
use common\services\system\StructService;
use common\models\system\Admin;

class AdminController extends BaseController
{
    use CommonAction;

    protected $model = Admin::class;
    protected $validate = true;

    /**
     * 首页渲染
     * @return string
     */
    protected function indexRender(): string
    {
        $root_id = intval($this->app->params['root_admin_id']);
        $roleList = (new RoleService())->getList();
        return $this->render('', ['root_id' => $root_id,'roleList'=>$roleList]);
    }

    /**
     * 首页列表查询前条件处理
     * @param array $params
     * @return array
     */
    protected function indexBefore(array $params): array
    {
        $userIdList = [];
        //角色处理
        $role_id = $params['role_id'] ?? '';
        if($role_id){
            $roleList = (new AdminRoleService())->getAdminIdByRoleId($role_id);
            if(!$roleList){
                $params['where']['id'] = 0;
                return $params;
            }
            $userIdList = $roleList;
        }

        //组织架构处理
        $contains = $params['contains']??0;
        $root_struct_id = intval($this->app->params['root_struct_id']);
        $struct_id = $params['structId'] ?? '';
        if ($struct_id) {
            $structList = [];
            if($contains){
                if($root_struct_id != $struct_id){
                    //获取所有子组织
                    $structList = StructService::getChildList($struct_id,true);
                    $structList[] = $struct_id;
                }
            }else{
                $structList[] = $struct_id;

            }
            if($structList){
                //获取组织下的用户
                $list = (new AdminStructService())->getAdminIdByStructId($structList);
                if(!$list){
                    $params['where']['id'] = 0;
                    return $params;
                }
                $userIdList = array_merge($userIdList,$list);
            }
        }
        if($userIdList){
            $params['in']['id'] = array_unique($userIdList);
        }
        return $params;
    }

    /**
     * 首页列表处理
     * @param array $list
     * @return array
     */
    protected function indexAfter(array $list): array
    {
        $structService = new AdminStructService();
        $roleService = new AdminRoleService();
        foreach ($list as $key => $value) {
            $structInfo = $structService->getStructByAdminId($value['id'], true);
            $value['struct_name'] = $structInfo ? implode(',',array_column($structInfo,'name')) : '';

            $roleList = $roleService->getRoleByAdmin($value['id'], true);
            $roleList = $roleList ? array_column($roleList, 'name') : [];
            $value['role_name'] = implode(',', $roleList);
            $list[$key] = $value;
        }
        return $list;
    }

    /**
     * 添加页渲染
     * @return string
     */
    protected function addRender(): string
    {
        $roleList = (new RoleService())->getList();
        return $this->render('', ['roleList' => $roleList]);
    }

    /**
     * 编辑页渲染
     * @param array $info
     * @return string
     */
    protected function editRender(array $info): string
    {
        $structInfo = (new AdminStructService())->getStructByAdminId($info['id'], true);

        $struct_id = implode(',',array_column($structInfo,'id'));
        $struct_name = implode(',',array_column($structInfo,'name'));

        $roleId = (new AdminRoleService())->getRoleByAdmin($info['id']);
        $roleList = (new RoleService())->getList();
        return $this->render('', ['info'=>$info,'roleList' => $roleList,'struct_id'=>$struct_id,'struct_name'=>$struct_name,'roleId'=>$roleId]);
    }

    /**
     * 验证前进行数据处理
     * @param $model
     * @param string $type
     * @return bool
     */
    protected function validateBefore($model, string $type)
    {
        if (isset($model['password']) && !$model['password']) {
            if ($type == 'add') {
                $model['password'] = '123456';
            } else if ($type == 'edit') {
                unset($model['password']);
            }
            if(isset($model['realname']) && !$model['realname']){
                $model['realname'] = $model['username'];
            }
        }
        return true;
    }

    /**
     * 添加和编辑保存前对数据进行处理
     * @param \yii\db\ActiveRecord $model
     * @param string $type
     * @return bool|string
     */
    protected function saveBefore(\yii\db\ActiveRecord $model, string $type)
    {
        if($type == 'add' || $type == 'edit'){

            if(isset($model['password'])){
                if(!$model['password']){
                    $model['password'] = $model['oldAttributes']['password'];
                }else{
                    $model['password'] = md5($model['password']);
                }
            }
        }
        return true;
    }

    /**
     * 添加和编辑后更新角色和组织信息
     * @param \yii\db\ActiveRecord $model
     * @param string $type
     */
    protected function saveAfter(\yii\db\ActiveRecord $model, string $type): void
    {
        if ($type == 'add' || $type == 'edit') {
            $roles = $this->request->post('roles', '');
            $struct = $this->request->post('struct', '');

            (new AdminRoleService())->update($model['id'], $roles);
            (new AdminStructService())->update($model['id'], $struct);
        }
    }

    /**
     * 删除前判断
     * @param array $data
     * @return bool|string
     */
    protected function deleteBefore(array $data)
    {
        $root_id = intval($this->app->params['root_admin_id']);
        if ($data['id'] == $root_id) {
            return '默认超级管理员无法删除';
        }
        return true;
    }

    /**
     * 删除后操作
     * @param array $data
     */
    protected function deleteAfter(array $data): void
    {
        //删除管理员角色
        (new AdminRoleService())->deleteByAdmin($data['id']);

        //删除管理员组织部门
        (new AdminStructService())->deleteByAdmin($data['id']);
    }
}
