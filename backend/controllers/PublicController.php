<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace backend\controllers;

use backend\extend\BaseController;
use backend\extend\models\LoginForm;
use common\helpers\Functions;
use common\helpers\Result;
use common\models\system\Loginlog;

class PublicController extends BaseController
{
    /**
     * 登录
     * @return array|string
     */
    public function actionLogin(){
        if($this->request->isPost){
            $model = new LoginForm();
            if(!$model->load($this->request->post(),'')){
                return $this->error('未获取到表单数据');
            }
            $result = $model->login();
            if(!$result){
                $msg = Functions::getModelError($model);
            }else{
                $msg = '登录成功';
            }
            Loginlog::logAdd($this->request->post('username',''),$result?1:0,$msg);
            if ($result) {
                return $this->success($msg);
            }else{
                return $this->error($msg);
            }
        }
        return $this->renderPartial();
    }

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'common\actions\CaptchaAction',
                'width' => 130,
                'height' => 48,
                'maxLength' => 5,
                'minLength' => 4,
                'offset'=>4
            ],
        ];
    }

    /**
     * 重写异常
     * @return array|string
     */
    public function actionError(){
        $exception = $this->app->errorHandler->exception;
        if ($exception !== null) {
            return $this->error($exception->getMessage(),$exception->statusCode);
        }
        return $this->error();
    }

    public function actionFail(){
        $getParam=$this->request->get();
        return $this->render('',['msg'=>$getParam['msg']??'','code'=>$getParam['code']??302]);
    }

    public function actionLogout(){
        $this->app->user->logout();
        $this->app->session->destroy();
        return $this->redirect(['index/index']);
    }

    public function actionNoauth(){
        return $this->renderPartial('fail',['msg'=>'未获取授权','code'=>302]);
    }
    public function actionCacheclear(){
        $this->app->db->schema->refresh();
        $this->app->cache->flush();
        return Result::success('清除完成');
    }

//    public function actionTestqueue(){
//        //测试消息队列发送邮箱  需要先执行 cmd下  yii queue/listen
//        //$this->app->queue->push  立即发送，  $this->app->queue->delay(60)延迟60秒运行
//        $id=$this->app->queue->push(new \common\components\jobs\EmailJob([
//            'name' => '测试用户',
//            'email' => '357145480@qq.com',
//            'type' => 'vemail'
//        ]));
//
//        echo $id;
//    }
}
