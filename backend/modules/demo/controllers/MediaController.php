<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\modules\demo\controllers;


use backend\extend\BaseController;
use backend\extend\traits\CommonAction;
use backend\modules\demo\models\Media;

class MediaController extends BaseController
{
    use CommonAction;
    protected $model = Media::class;

}
