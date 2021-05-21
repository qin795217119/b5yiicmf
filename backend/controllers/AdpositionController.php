<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\cache\AdpositionCache;
use common\helpers\commonApi;
use common\models\Adposition;

/**
 * 推荐位置控制器
 * Class AdpositionController
 * @package backend\controllers
 */
class AdpositionController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model = Adposition::class;
    }
    public function actionDelcache(){
        AdpositionCache::clear();
        return commonApi::message();
    }
}
