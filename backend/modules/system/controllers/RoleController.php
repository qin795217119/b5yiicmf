<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\modules\system\controllers;


use backend\extend\BaseController;
use backend\extend\helpers\DataScopeHelper;
use backend\extend\traits\CommonAction;
use common\services\system\AdminRoleService;
use common\services\system\RoleMenuService;
use common\services\system\RoleStructService;
use common\models\system\Role;

class RoleController extends BaseController
{
    use CommonAction;

    protected string $model = Role::class;
    protected bool $validate = true;

    /**
     * 首页渲染
     * @return string
     */
    protected function indexRender(): string
    {
        $root_id = intval($this->app->params['root_role_id']);
        return $this->render('', ['root_id' => $root_id]);
    }

    /**
     * 角色授权
     * @return array|string
     */
    public function actionAuth()
    {
        if ($this->request->isPost) {
            $role_id = $this->request->post('id', 0);
            $treeId = $this->request->post('treeId', '');
            $result = RoleMenuService::update($role_id, $treeId);
            if (!$result) {
                return $this->error('授权发生错误');
            }
            return $this->success();
        } else {
            $role_id = $this->request->get('role_id', 0);
            if (!$role_id) return $this->error('参数错误');
            $info = Role::findOne($role_id);
            if (empty($info)) return $this->error('角色信息不存在');
            $menuList = RoleMenuService::getRoleMenuList($role_id);
            return $this->render("", ['info' => $info->toArray(), 'menuList' => implode(',', $menuList)]);
        }
    }

    /**
     * 角色数据权限
     * @return array|string
     */
    public function actionDatascope()
    {
        if ($this->request->isPost) {
            $role_id = $this->request->post('id', 0);
            if (!$role_id) {
                return $this->error('参数错误');
            }
            $info = Role::findOne($role_id);
            if (empty($info)) {
                return $this->error('角色信息不存在');
            }
            $dataList = DataScopeHelper::typeList();//数据范围列表
            $data_scope = $this->request->post('data_scope', '');
            if (!$data_scope || !array_key_exists($data_scope, $dataList)) {
                return $this->error('请选择数据范围');
            }
            $treeId = $this->request->post('treeId', '');
            $result = RoleStructService::update($role_id, $data_scope == '8' ? $treeId : '');
            if (!$result) {
                return $this->error('发生错误了');
            }
            $info->data_scope = $data_scope;
            $result = $info->save(false);
            if ($result === false) {
                return $this->error('数据保存失败');
            }
            return $this->success();
        } else {
            $role_id = $this->request->get('role_id', 0);
            if (!$role_id) {
                return $this->error('参数错误');
            }
            $info = Role::findOne($role_id);
            if (empty($info)) {
                return $this->error('角色信息不存在');
            }
            $typeList = DataScopeHelper::typeList();//数据范围列表
            $userStruct = RoleStructService::getRoleStructList($role_id);
            return $this->render("", ['info' => $info->toArray(), 'typeList' => $typeList, 'userStruct' => implode(',', $userStruct)]);
        }
    }

    /**
     * 删除前判断
     * @param Role $model
     * @return string
     */
    protected function deleteBefore(Role $model): string
    {
        $root_id = intval($this->app->params['root_role_id']);
        if ($model->id == $root_id) {
            return '默认超管角色无法删除';
        }
        return '';
    }

    /**
     * 删除角色后
     * @param Role $model
     */
    protected function deleteAfter(Role $model): void
    {
        //删除对应的管理员角色信息
        AdminRoleService::deleteByRole($model->id);

        //删除对应的权限菜单信息
        RoleMenuService::deleteByRole($model->id);

        //删除对应角色数据权限信息
        RoleStructService::deleteByRole($model->id);
    }
}
