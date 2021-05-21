<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\actions;

use yii\base\Action;
use common\helpers\Captcha\Captcha;
use Yii;

class CaptchaAction extends Action
{
    public $imageW  = 120;// 验证码图片宽度
    public $imageH  = 40;// 验证码图片高度
    public $length  = 5;// 验证码位数
    public $bg = [230,230,230];

    public function run()
    {
        $captcha=new Captcha(['imageW'=>$this->imageW,'imageH'=>$this->imageH,'length'=>$this->length,'bg'=>$this->bg]);
        return $captcha->entry();
    }
}