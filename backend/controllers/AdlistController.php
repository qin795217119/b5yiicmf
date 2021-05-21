<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\cache\AdpositionCache;
use common\models\Adlist;
use Yii;

/**
 * 推荐信息控制器
 * Class AdlistController
 * @package backend\controllers
 */
class AdlistController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model = Adlist::class;
        if (IS_RENDER) {
            Yii::$app->view->params['adposList'] = AdpositionCache::get('id',);
        }
    }
}
