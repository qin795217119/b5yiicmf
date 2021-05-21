<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\models\DictData;
use common\services\DictTypeService;
use Yii;

/**
 * 字典数据控制器
 * Class DictdataController
 * @package backend\controllers
 */
class DictdataController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model = DictData::class;
        if(Yii::$app->request->isGet && !Yii::$app->request->isAjax){
            Yii::$app->view->params['typeList']=DictTypeService::getTypeList();
        }
    }
}
