<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\helpers\commonApi;
use common\models\Loginlog;

/**
 * 登录记录控制器
 * Class LoginlogController
 * @package backend\controllers
 */
class LoginlogController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model = Loginlog::class;
    }

    public function actionTrash(){
        (new Loginlog())->trash();
        return commonApi::message();
    }
}
