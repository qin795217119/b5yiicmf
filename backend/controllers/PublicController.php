<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use backend\models\LoginForm;
use common\helpers\commonApi;
use Yii;

/**
 * 公共操作控制器
 * Class PublicController
 * @package backend\controllers
 */
class PublicController extends BaseController
{
    public function actionLogin(){
        if(IS_POST){
            if (Yii::$app->user->isGuest) {
                $model = new LoginForm();
                if(!$model->load(Yii::$app->request->post(),'')){
                    return $model->loginResult('未获取到表单数据',false);
                }
                if ($model->login()) {
                    return $model->loginResult('登录成功',true);
                }
                return $model->loginResult(commonApi::getModelError($model),false);
            }
            return commonApi::message('已登录',true);
        }
        if (Yii::$app->user->isGuest) {
            return $this->renderPartial('login');
        }
        return $this->redirect(['index/index']);
    }

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
        return $this->render('',['msg'=>$getParam['msg']??'','code'=>$getParam['code']??302]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();
        Yii::$app->session->destroy();
        return $this->redirect(['index/index']);
    }

    public function actionNoauth(){
        return $this->renderPartial('fail',['msg'=>'未获取授权','code'=>302]);
    }
}
