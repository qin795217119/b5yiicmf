<?php

namespace backend\controllers;

use common\helpers\commonApi;
use common\models\Community;
use common\models\cu\CuImage;
use common\models\DemoImg;
use common\services\task\TaskUserPostService;
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
