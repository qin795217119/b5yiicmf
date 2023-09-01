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
use common\models\system\LoginLog;

class LoginLogController extends BaseController
{
    use CommonAction;

    protected string $model = LoginLog::class;

    /**
     * 清空数据
     * @return array|string
     */
    public function actionTrash()
    {
        if ($this->request->isPost) {
            LoginLog::trash();
            return $this->success('数据情况完毕');
        }
        return $this->error('请求方式错误');
    }
}
