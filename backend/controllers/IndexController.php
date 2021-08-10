<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use backend\helpers\commonBack;
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
        $menuHtml=MenuService::getMenuListByLogin();
        $adminInfo=commonBack::adminLoginInfo();

        unset($adminInfo['menu']);
        unset($adminInfo['role']);
        $adminInfo['struct']=$adminInfo['struct']?$adminInfo['struct'][0]['name']:'未分配';
        return $this->renderPartial('index',['menuHtml'=>$menuHtml,'adminInfo'=>$adminInfo]);
    }

    public function actionHome(){
       return $this->render();
    }



    public function actionDownload(){
        $fileName = \Yii::$app->request->get('fileName','');
        if(!$fileName) return $this->tError('参数错误');
        $root =\Yii::getAlias('@approot');
        if(!file_exists($root.$fileName)) return $this->tError('文件不存在');
        $fileUrl = commonApi::getDomain($fileName);
        header('location:'.$fileUrl);
    }
}
