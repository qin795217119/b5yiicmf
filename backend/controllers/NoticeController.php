<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\controllers;

use backend\extend\BaseController;
use backend\extend\traits\CommonAction;
use common\models\Notice;

class NoticeController extends BaseController
{
    use CommonAction;

    protected string $model = Notice::class;


}
