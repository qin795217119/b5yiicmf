<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use backend\models\LoginForm;
use common\helpers\commonApi;
use common\helpers\MailApi;
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


    public function actionTestqueue(){
        //测试消息队列发送邮箱  需要先执行 cmd下  yii queue/listen
        //Yii::$app->queue->push  立即发送，  Yii::$app->queue->delay(60)延迟60秒运行
        $id=Yii::$app->queue->push(new \common\components\jobs\EmailJob([

            'name' => '测试用户',
            'email' => '357145480@qq.com',
            'type' => 'vemail'
        ]));

        echo $id;
    }

    public function actionTestemail(){

        //测试邮箱发送
        $res=(new MailApi())->sendEmail('vemail',['email'=>'357145480@qq.com','name'=>'用户名111']);
        var_dump($res);
    }
}
