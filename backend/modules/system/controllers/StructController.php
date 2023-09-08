<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\modules\system\controllers;

use backend\extend\BaseController;
use backend\extend\traits\CommonAction;
use common\services\system\AdminStructService;
use common\services\system\RoleStructService;
use common\services\system\StructService;
use common\models\system\Struct;

class StructController extends BaseController
{
    use CommonAction;

    protected string $model = Struct::class;
    protected bool $validate = true;

    /**
     * 树形页面
     * @return array|string
     */
    public function actionTree()
    {
        if ($this->request->isPost) {
            $list = StructService::getList();
            return $this->success('', $list);
        } else {//是否显示父级名称
            $parent = $this->request->get('parent', 0);
            $id = $this->request->get('id', 0);
            $ismult = $this->request->get('ismult', 0);
            return $this->render('', ['struct_id' => $id, 'parent' => $parent, 'ismult' => $ismult]);
        }
    }

    /**
     * 首页渲染
     * @return string
     */
    protected function indexRender(): string
    {
        $root_id = intval($this->app->params['root_struct_id']);
        return $this->render('', ['root_id' => $root_id]);
    }

    /**
     * 首页列表默认排序
     * @param array $params
     * @return array
     */
    protected function indexBefore(array $params): array
    {
        $params['orderBy'] = ['parent_id' => 'asc', 'list_sort' => 'asc'];
        return $params;
    }

    /**
     * 添加页渲染
     * @return string
     */
    protected function addRender(): string
    {
        $root_id = intval($this->app->params['root_struct_id']);
        $rootInfo = Struct::findOne($root_id);
        if (!$rootInfo) {
            return $this->error("根组织错误，请添加根组织ID：" . $root_id);
        }
        return $this->render('', ['root_id' => $root_id, 'root_name' => $rootInfo['name']]);
    }

    /**
     * 编辑页渲染
     * @param Struct $model
     * @return string
     */
    protected function editRender(Struct $model): string
    {
        $parent_name = '顶级部门';
        if ($model->parent_id) {
            $parent_name = implode('-', explode(',', $model->parent_name));
        }
        $root_id = intval($this->app->params['root_struct_id']);
        return $this->render('', ['info' => $model, 'root_id' => $root_id,'parent_name'=>$parent_name]);
    }

    /**
     * 添加和编辑保存前 处理 父级信息
     * @param Struct $model
     * @param string $type
     * @return string
     */
    protected function saveBefore(Struct $model, string $type): string
    {
        if ($type == 'add' || $type == 'edit') {
            $root_id = intval($this->app->params['root_struct_id']);
            if ($type == 'add' && !$model->parent_id) {
                return '不能添加顶级部门';
            }
            if ($type == 'edit' && $model->id == $root_id && $model->parent_id) {
                return '顶级部门不能修改上级部门';
            }
            if ($model->parent_id) {
                $parentInfo = Struct::findOne($model->parent_id);
                if (!$parentInfo) return '上级部门信息不存在';
                $model->parent_name = trim($parentInfo->parent_name . ',' . $parentInfo->name, ',');
                $model->levels = trim($parentInfo->levels . ',' . $parentInfo->id, ',');
            }
        }
        return '';
    }

    /**
     * 修改后 进行fullname和levels更新
     * @param Struct $model
     * @param string $type
     */
    protected function saveAfter(Struct $model, string $type): void
    {
        if ($type == 'edit') {
            StructService::updateExtendField($model->id);
        }
    }

    /**
     * 删除后操作
     * @param Struct $model
     */
    protected function deleteAfter(Struct $model): void
    {
        //删除管理员组织信息
        AdminStructService::deleteByStruct($model->id);

        //删除角色数据权限信息
        RoleStructService::deleteByStruct($model->id);
    }
}
