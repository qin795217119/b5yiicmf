<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\helpers\commonApi;
use common\services\MenuService;

/**
 * 首页控制器
 * Class IndexController
 * @package backend\controllers
 */
class IndexController extends BaseController
{
    public function actionIndex(){
        $menuHtml=(new MenuService())->getMenuListByLogin();
        $adminInfo=commonApi::adminLoginInfo();
        unset($adminInfo['menu']);
        unset($adminInfo['role']);
        $adminInfo['struct']=$adminInfo['struct']?$adminInfo['struct'][0]['name']:'未分配';
        return $this->renderPartial('index',['menuHtml'=>$menuHtml,'adminInfo'=>$adminInfo]);
    }

    public function actionHome(){
       return $this->render();
    }
}
