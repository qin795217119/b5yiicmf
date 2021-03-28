<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace h5\controllers;

use common\helpers\WechatApi;
use Yii;
use yii\helpers\Url;

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
            ]
        ];
    }

    public function actionFail(){
        $getParam=Yii::$app->request->get();
        return $this->renderPartial('',['msg'=>$getParam['msg']??'','code'=>$getParam['code']??302]);
    }

    /**
     * 微信授权统一回调处理
     * @return \yii\web\Response
     */
    public function actionWxauth(){
        $res=(new WechatApi())->authInfo();
        if($res){
            if($res['success']){
                Yii::$app->session->set('wap_openid_'.$res['data']['userInfo']['type'],$res['data']['userInfo']['openid']);
                return $this->redirect($res['data']['url']);
            }else{
                return $this->redirect(Url::toRoute(['fail','msg'=>$res['msg']]));
            }
        }
        return $this->redirect(Url::toRoute(['fail','msg'=>'授权错误']));
    }
}
