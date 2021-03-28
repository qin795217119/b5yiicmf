<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace pc\controllers;

use Yii;

/**
 * 公共操作控制器
 * Class PublicController
 * @package backend\controllers
 */
class PublicController extends BaseController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'common\actions\CaptchaAction',
                'imageW' => 130,
                'imageH' => 48,
                'length' => 4
            ],
        ];
    }

    public function actionFail(){
        $getParam=Yii::$app->request->get();
        return $this->renderPartial('',['msg'=>$getParam['msg']??'','code'=>$getParam['code']??302]);
    }
}
