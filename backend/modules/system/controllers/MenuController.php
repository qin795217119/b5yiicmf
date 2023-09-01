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
     * @return string
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
     * @param $info
     * @return string
     */
    protected function editRender($info): string
    {
        if ($info['parent_id']) {
            $parent = Menu::findOne($info['parent_id']);
            if ($parent) {
                $info['parent_name'] = $parent['name'];
            } else {
                $info['parent_name'] = '错误：' . $info['parent_id'];
            }
        } else {
            $info['parent_name'] = '顶级菜单';
        }

        return $this->render('', ['info' => $info, 'typeList' => MenuService::typeList()]);
    }

    /**
     * 删除后操作
     * @param array $data
     */
    protected function deleteAfter(array $data): void
    {
        //删除菜单的角色授权
        RoleMenuService::deleteByMenu($data['id']);
    }
}
