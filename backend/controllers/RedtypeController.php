<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\services\RedtypeService;

/**
 * 跳转管理控制器去
 * Class RedtypeController
 * @package backend\controllers
 */
class RedtypeController extends BaseController
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->service = new RedtypeService();
    }
}
