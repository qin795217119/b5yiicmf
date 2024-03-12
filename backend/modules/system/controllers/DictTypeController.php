<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\modules\system\controllers;

use backend\extend\BaseController;
use backend\extend\traits\CommonAction;
use common\models\system\DictType;
use common\services\system\DictService;


class DictTypeController extends BaseController
{
    use CommonAction;

    protected string $model = DictType::class;
    protected bool $validate = true;


    protected function deleteAfter(DictType $model, string $type): void
    {
        DictService::deleteDictDataByType($model->type);
    }
}
