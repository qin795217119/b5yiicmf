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
use common\cache\PositionCache;
use common\models\system\Position;
use common\services\system\AdminPosService;


class PositionController extends BaseController
{
    use CommonAction;

    protected string $model = Position::class;

    protected function saveAfter(\yii\db\ActiveRecord $model, string $type, array $extend = []): void
    {
        PositionCache::clear();
    }

    protected function deleteAfter(array $data, string $type): void
    {
        PositionCache::clear();
        //删除岗位绑定的人员信息
        AdminPosService::deleteByPos($data['id']);
    }

}
