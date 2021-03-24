<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use backend\models\ResetPasswordForm;
use common\helpers\commonApi;
use Yii;

/**
 * 公共操作控制器
 * Class AdminController
 * @package backend\controllers
 */
class CommonController extends BaseController
{
    /**
     * 公共action操作
     * @return array
     */
    public function actions(){
        return [
            'uploadimg'=>[
                'class'=>'common\actions\UploadAction',
                'type'=>'img'
            ],
        ];
    }

    /**
     * 锁屏
     * @return array|string
     * @throws \Exception
     */
    public function actionLockscreen(){
        if (IS_POST){
            $password=Yii::$app->request->post('password','');
            if(empty($password)){
                return commonApi::message('请输入密码',false);
            }
            $userInfo=Yii::$app->user->identity;
            if(!$userInfo){
               return commonApi::message('用户信息丢失，请重新登录',false);
            }
            if(!$userInfo->validatePassword($password)){
                return commonApi::message('密码错误',false);
            }
            if($userInfo->status!=1){
                return commonApi::message('用户状态错误，请重新登录',false);
            }
            Yii::$app->session->remove('islock');
            return commonApi::message('登录成功',true);
        }else{
            Yii::$app->session->set('islock',true);
            $user=commonApi::adminLoginInfo('info');
            return $this->renderPartial('lockscreen',['user'=>$user]);
        }
    }

    //修改密码
    public function actionRepass(){
        if(IS_POST){
            $model = new ResetPasswordForm();
            if(!$model->load(Yii::$app->request->post(),'')){
                return commonApi::message('未获取到表单数据',false);
            }
            if ($model->resetPassword()) {
                return commonApi::message('密码设置成功',true,[],null,'closeOpen');
            }
            return commonApi::message(commonApi::getModelError($model),false);
        }
        return $this->render('',['name'=>commonApi::adminLoginInfo('info.name')]);
    }
}
