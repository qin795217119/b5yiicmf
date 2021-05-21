<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\cache\DictCache;
use common\helpers\commonApi;
use common\models\DictType;

/**
 * 字典类型控制器
 * Class DictController
 * @package backend\controllers
 */
class DictController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model = DictType::class;
    }
    public function actionDelcache(){
        DictCache::clear();
        return commonApi::message();
    }
}
