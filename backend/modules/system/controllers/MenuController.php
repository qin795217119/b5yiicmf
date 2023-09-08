<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\modules\system\controllers;

use backend\extend\BaseController;
use common\services\system\MenuService;
use backend\extend\traits\CommonAction;
use common\services\system\RoleMenuService;
use common\models\system\Menu;

class MenuController extends BaseController
{
    use CommonAction;

    protected string $model = Menu::class;
    protected bool $validate = true;

    /**
     * 获取菜单列表
     * @return array|string
     */
    public function actionTree()
    {
        $root = $this->request->get('root', 0);
        if ($this->request->isPost) {
            $list = MenuService::getList($root ? true : false);
            return $this->success('', $list);
        } else {
            $id = $this->request->get('id', 0);
            return $this->render('', ['menu_id' => $id, 'root' => $root]);
        }
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
     * 添加渲染
     * @return string
     */
    protected function addRender(): string
    {
        return $this->render('', ['typeList' => MenuService::typeList()]);
    }

    /**
     * 编辑渲染
     * @param Menu $model
     * @return string
     */
    protected function editRender(Menu $model): string
    {
        $parent_name = '顶级菜单';
        if ($model->parent_id) {
            $parent = Menu::findOne($model->parent_id);
            if ($parent) {
                $parent_name = $parent['name'];
            } else {
                $parent_name = '错误：' . $model->parent_id;
            }
        }

        return $this->render('', ['info' => $model,'parent_name'=>$parent_name, 'typeList' => MenuService::typeList()]);
    }

    /**
     * 删除后操作
     * @param Menu $model
     */
    protected function deleteAfter(Menu $model): void
    {
        //删除菜单的角色授权
        RoleMenuService::deleteByMenu($model->id);
    }
}
