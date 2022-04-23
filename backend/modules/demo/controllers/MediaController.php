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
use common\helpers\Functions;

class MediaController extends BaseController
{
    use CommonAction;
    protected $model = Media::class;

    public function indexAfter(array $list): array
    {
        foreach ($list as $key=>$value){
            $value['img'] = Functions::getFileUrl($value['img']);
            $value['imgs'] = Functions::getFileUrlList($value['imgs'],false);
            $value['crop'] = Functions::getFileUrlList($value['crop'],false);
            $value['video'] = Functions::getFileUrlList($value['video'],false);
            $value['file'] = Functions::getFileUrlList($value['file'],false);
            $value['files'] = Functions::getFileUrlList($value['files'],false);
            $list[$key] = $value;
        }
        return $list;
    }
}
