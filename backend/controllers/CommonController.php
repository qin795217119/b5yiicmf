<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\controllers;

use backend\extend\BaseController;
use backend\extend\helpers\LoginAuthHelper;
use backend\extend\models\ResetPasswordForm;
use common\helpers\Functions;
use common\helpers\Result;
use Yii;

class CommonController extends BaseController
{
    /**
     * 公共action操作
     * @return array
     */
    public function actions(): array
    {
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
    public function actionCropper(): string
    {
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
        if (Yii::$app->request->isPost){
            $password=Yii::$app->request->post('password','');
            if(empty($password)){
                return Result::error('请输入密码');
            }
            $userInfo=Yii::$app->user->identity;
            if(!$userInfo){
                return Result::error('用户信息丢失，请重新登录');
            }
            if(!$userInfo->validatePassword($password)){
                return Result::error('密码错误');
            }
            Yii::$app->session->remove('islock');
            return Result::success('登录成功');

        }else{
            Yii::$app->session->set('islock',true);
            $user=LoginAuthHelper::adminLoginInfo('info');
            return $this->renderPartial('lockscreen',['user'=>$user]);
        }
    }

    //修改密码
    public function actionRepass(){
        if(Yii::$app->request->isPost){
            $model = new ResetPasswordForm();
            if($model->load(Yii::$app->request->post(),'') && $model->resetPassword()){
                return Result::success('密码设置成功');
            }
            return Result::error(Functions::getModelError($model));
        }else{
            return $this->render('');
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
                return Result::success('转换中，请耐心等待');
            }
        }
        return Result::error('任务失败');

    }

}
