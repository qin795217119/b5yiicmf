<?php
namespace api\modules\v1\controllers;

use api\components\BaseController;
use common\helpers\commonApi;
use common\helpers\WechatApi;
use Yii;
use yii\helpers\Url;

class WechatauthController extends BaseController
{
    public function actionGetopenid(){
        //前台传入的 授权成功跳转到前台url
        $app_url=Yii::$app->request->get('redrecturi','');
        $app_url=str_replace('=','#',base64_encode($app_url));

        $url=Url::toRoute(['wxauth','b5reduri'=>$app_url],true);
        return (new WechatApi())->getOpenId($url);
    }
    public function actionWxauth(){
        $res=(new WechatApi())->authInfo();
        if($res){
            if($res['success']){

                $app_url = $res['data']['url'];
                $userInfo = $res['data']['userInfo'];
                $token = $this->setToken($userInfo['id']);
                $app_url=base64_decode(str_replace('#','=',$app_url));
                $app_url=commonApi::urlCreate($app_url,'token='.$token);

                return $this->redirect($app_url);
            }else{
                return $this->redirect(Url::toRoute(['fail','msg'=>$res['msg']]));
            }
        }
        return $this->redirect(Url::toRoute(['fail','msg'=>'授权错误']));
    }
}