<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\services\AdpositionService;

/**
 * 推荐位置控制器
 * Class AdpositionController
 * @package backend\controllers
 */
class AdpositionController extends BaseController
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->service=new AdpositionService();
    }
}