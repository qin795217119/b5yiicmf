<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\cache\DictCache;
use common\models\Notice;
use Yii;

/**
 * 通知公告控制器
 * Class NoticeController
 * @package backend\controllers
 */
class NoticeController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model = Notice::class;
        if(IS_RENDER){
            Yii::$app->view->params['typeList']=DictCache::get('sys_notice_type');
        }
    }

}
