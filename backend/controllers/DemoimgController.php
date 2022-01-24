<?php

namespace backend\controllers;

use common\models\DemoImg;
use Yii;

/**
 * 社区图片管理
 * Class DemoimgController
 * @package backend\controllers
 */
class DemoimgController extends BaseController
{

    public function init()
    {
        parent::init();
        $this->model = DemoImg::class;
    }


}
