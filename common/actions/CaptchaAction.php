<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\actions;


class CaptchaAction extends \yii\captcha\CaptchaAction
{
    public function run()
    {
        $this->setHttpHeaders();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        return $this->renderImage($this->getVerifyCode(true));
    }
}