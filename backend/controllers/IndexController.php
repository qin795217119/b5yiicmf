<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\controllers;

use backend\extend\BaseController;
use backend\extend\helpers\LoginAuthHelper;
use common\helpers\Functions;
use common\models\system\Menu;
use yii\helpers\Url;

class IndexController extends BaseController
{
    /**
     * 首页
     * @return string
     */
    public function actionIndex()
    {
        //是否开启横向菜单
        $topNav = false;

        $userInfo = LoginAuthHelper::adminLoginInfo();
        $menuTree = $this->getMenuListByLogin();
        if($topNav){
            return $this->renderPartial('indextop', ['user_info' => $userInfo, 'menuList' => $menuTree]);
        }
        $menuHtml = $this->menuToHtml($menuTree);
        return $this->renderPartial('', ['user_info' => $userInfo, 'menuHtml' => $menuHtml]);
    }

    /**
     * 主页
     * @return string
     */
    public function actionHome()
    {
        return $this->render();
    }

    /**
     * 下载文件
     * @return array|string
     */
    public function actionDownload(){
        $fileName = $this->request->get('fileName','');
        if(!$fileName) return $this->error('参数错误');
        header('location:'.Functions::getFileUrl($fileName));
    }
    /**
     * 根据登录session获取菜单
     * @return array
     */
    protected function getMenuListByLogin(): array
    {
        $menuTree = $menuList = [];
        $adminId = LoginAuthHelper::adminLoginInfo('info.id');
        if ($adminId) {
            $isAdmin = LoginAuthHelper::adminLoginInfo('info.is_admin');

            if ($isAdmin) {
                $menuList = Menu::find()->select(['id', 'type', 'name', 'url', 'parent_id', 'icon', 'is_refresh', 'target'])->where(['<>', 'type', 'F'])->andWhere(['status' => 1])->orderBy('parent_id asc,listsort asc,id asc')->asArray()->all();
            } else {
                $menuIdList = LoginAuthHelper::adminLoginInfo('menu');
                if ($menuIdList) {
                    //获取菜单
                    $menuList = Menu::find()->select(['id', 'type', 'name', 'url', 'parent_id', 'icon', 'is_refresh', 'target'])->where(['id' => $menuIdList])->andwhere(['<>', 'type', 'F'])->andWhere(['status' => 1])->orderBy('parent_id asc,listsort asc,id asc')->asArray()->all();
                }
            }
        }

        if ($menuList) {
            $menuTree = $this->getMenuTree($menuList);
        }
        return $menuTree?:[];
    }


    /**
     * 将菜单转为数形无限极
     * @param $list
     * @param int $pid
     * @param int $deep
     * @return array
     */
    protected function getMenuTree($list, $pid = 0, $deep = 0): array
    {
        $tree = [];
        foreach ($list as $key => $row) {
            if ($row['parent_id'] == $pid) {
                $row['deep'] = $deep;
                $url = $row['url'];
                if ($url && strpos($url, 'http') !== 0) {
                    $row['url'] = Url::toRoute($url);
                }
                unset($list[$key]);
                $row['child'] = $this->getMenuTree($list, $row['id'], $deep + 1);
                $tree[] = $row;
            }
        }
        return $tree;
    }

    /**
     * 将菜单树形转为html
     * @param $menus
     * @param int $deep
     * @return string
     */
    protected function menuToHtml($menus, $deep = 0): string
    {
        $html = '';
        if (is_array($menus)) {
            foreach ($menus as $t) {
                if ($t['deep'] == $deep) {
                    if ($t['type'] == 'C') {
                        $url = $t['url'];
                        if ($t['parent_id'] == 0) {
                            $html .= '<li><a class="' . ($t['target'] == '1' ? 'menuBlank' : 'menuItem') . '" href="' . $url . '" data-refresh="' . ($t['is_refresh'] ? 'true' : 'false') . '">' . ($t['icon'] ? '<i class="' . $t['icon'] . '"></i>' : '') . ' <span class="nav-label">' . $t['name'] . '</span></a></li>';
                        } else {
                            $html .= '<li><a class="' . ($t['target'] == '1' ? 'menuBlank' : 'menuItem') . '" href="' . $url . '" data-refresh="' . ($t['is_refresh'] ? 'true' : 'false') . '">' . $t['name'] . '</a></li>';
                        }

                    } else {
                        //实现最多三级菜单
                        if ($t['child'] && $deep < 3) {
                            $html .= '<li><a href="javascript:;">' . ($t['icon'] ? '<i class="' . $t['icon'] . '"></i>' : '') . ' <span class="nav-label">' . $t['name'] . '</span><span class="fa arrow"></span></a>';
                            $html .= '<ul class="nav ' . ($deep == 0 ? 'nav-second-level' : 'nav-third-level') . '">';
                            $html .= $this->menuToHtml($t['child'], $deep + 1);
                            $html = $html . "</ul></li>";
                        }
                    }
                }

            }
        }
        return $html;
    }


}
