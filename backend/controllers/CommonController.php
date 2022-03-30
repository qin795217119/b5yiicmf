<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\controllers;

use backend\extend\BaseController;
use Yii;

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
            'uploadvideo'=>[
                'class'=>'common\actions\UploadAction',
                'type'=>'video'
            ],
            'uploadfile'=>[
                'class'=>'common\actions\UploadAction',
                'type'=>'file'
            ],
        ];
    }

    /**
     * 裁剪图片
     * @return string
     */
    public function actionCropper(){
        $data=[
            'id' => Yii::$app->request->get('id',''),
            'cat' => Yii::$app->request->get('cat','')
        ];
        return $this->render('',$data);
    }


    /**
     * 锁屏
     * @return array|string
     * @throws \Exception
     */
    public function actionLockscreen(){
        if (IS_RENDER){
            Yii::$app->session->set('islock',true);
            $user=CommonBack::adminLoginInfo('info');
            return $this->renderPartial('lockscreen',['user'=>$user]);
        }else{
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
        }
    }

    //修改密码
    public function actionRepass(){
        if(IS_RENDER){
            return $this->render('',['name'=>CommonBack::adminLoginInfo('info.name')]);
        }else{
            $model = new ResetPasswordForm();
            if(!$model->load(Yii::$app->request->post(),'')){
                return commonApi::message('未获取到表单数据',false);
            }
            if ($model->resetPassword()) {
                return commonApi::message('密码设置成功',true,[],null,'closeOpen');
            }
            return commonApi::message(commonApi::getModelError($model),false);
        }

    }

    /**
     * 视频处理
     * @return array
     */
    public function actionVideoclip(){
        $id = Yii::$app->request->post('id',0);
        if($id){
            $res=Yii::$app->queue->push(new \common\components\jobs\VideoClipJob([
                'id' =>$id
            ]));
            if($res){
                return commonApi::message('转换中，请耐心等待',true);
            }
        }
        return commonApi::message('任务失败',false);

    }

//    public function actionVideoclip(){
//        $id = Yii::$app->request->post('id',0);
//        $res = VideoClipService::run($id);
//        if($res){
//            return commonApi::message('转换中，请耐心等待',true);
//        }
//        return commonApi::message('操作失败',false);
//    }
}
