<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace api\components;

use common\helpers\Functions;
use common\helpers\WechatHelper;
use yii\helpers\Url;

/**
 * 微信授权通用方法
 * Class FilterWechat
 * @package api\components
 */
trait TraitWechat
{
    /**
     * 只获取openid
     * 前端需要调用授权方法，需要直接跳转到该连接
     * @return \yii\console\Response|\yii\web\Response
     */
    public function actionGetOpenId(){
        return $this->toWxAuth(false);
    }
    /**
     * 获取微信用户详细信息
     * 前端需要调用授权方法，需要直接跳转到该连接
     * @return mixed
     */
    public function actionGetWxUser(){
        return $this->toWxAuth(true);
    }

    /**
     * 统一授权
     * @param bool $isUser
     * @return \yii\console\Response|\yii\web\Response
     */
    private function toWxAuth(bool $isUser){
        //授权后的跳转地址，由前端决定
        $after_url=$this->request->get('after_url','');
        //对地址进行处理，防止传递过程中出错
        $after_url=str_replace('=','#',base64_encode($after_url));

        //跳转到当前的授权地址
        //mytype 可以用来区分不同的应用，也可以不穿
        $auth_url=Url::toRoute(['get-wechat-code','after_url'=>$after_url,'user_info'=>$isUser?1:0],true);
        return (new WechatHelper($isUser))->getOpenId(urldecode($auth_url));
    }

    /**
     * 微信授权后回调的连接，由上面的方法决定
     */
    public function actionGetWechatCode(){
        $isUser = intval($this->request->get('user_info',1));
        if($isUser == 1){
            $wechat = new WechatHelper(true);//获取详细信息
        }else{
            $wechat = new WechatHelper(false);//只获取openid
        }
        $result = $wechat->getUserInfo();
        if(!$result['success']){
            return $result;
        }
        //$mtype = $result['data']['mtype'];

        $openid = $result['data']['openid'];

        //如果获取用户
//        $userInfo = $result['data']['userInfo'];

        $after_url = $this->request->get('after_url','');
        $after_url=base64_decode(str_replace('#','=',$after_url));

        $after_url=Functions::urlContact($after_url,'openid='.$openid);
        return $this->response->redirect($after_url);
    }
}