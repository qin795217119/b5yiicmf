<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\services\LoginlogService;

/**
 * 登录记录控制器
 * Class LoginlogController
 * @package backend\controllers
 */
class LoginlogController extends BaseController
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->service = new LoginlogService(false);
    }
    public function actionTrash(){
        return $this->service->trash();
    }
}
