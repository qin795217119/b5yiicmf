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
use common\models\system\DictData;
use common\services\system\DictService;


class DictDataController extends BaseController
{
    use CommonAction;

    protected string $model = DictData::class;
    protected bool $validate = true;


    protected function indexRender(): string
    {
        $type = $this->request->get('type', '');
        if (!$type) return $this->error('缺少类型参数');
        return $this->render('', ['typeList' => DictService::getDictTypeList(true), 'type' => $type]);
    }

    protected function addRender(): string
    {
        $typeInfo = DictService::getDictTypeInfo($this->request->get('id', ''));
        if (!$typeInfo) return $this->error('类型参数错误');
        return $this->render('', ['typeInfo' => $typeInfo]);
    }

    protected function editRender(DictData $model): string
    {
        $typeInfo = DictService::getDictTypeInfo($model->type);
        if (!$typeInfo) return $this->error('类型信息不存在');
        return $this->render('', ['typeInfo' => $typeInfo, 'info' => $model]);
    }
}
