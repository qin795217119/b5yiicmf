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
     * 前端需要调用授权方法，需要直接跳转到该连接
     * @return mixed
     */
    public function actionGetopenid(){

        //授权后的跳转地址，由前端决定
        $after_url=\Yii::$app->request->get('after_url','');

        //对地址进行处理，防止传递过程中出错
        $after_url=str_replace('=','#',base64_encode($after_url));

        //跳转到当前的授权地址
        //mytype 可以用来区分不同的应用，也可以不穿
        $auth_url=Url::toRoute(['getwechatcode','after_url'=>$after_url,'mytype'=>'vote_1'],true);

        return (new WechatHelper())->getOpenId($auth_url);
    }

    /**
     * 微信授权后回调的连接，由上面的方法决定
     */
    public function actionGetwechatcode(){
        $result = (new WechatHelper())->getUserInfo();
        if(!$result['success']){
            return $result;
        }
        //$mtype = $result['data']['mtype'];

        $openid = $result['data']['openid'];

        //如果获取用户
//        $userInfo = $result['data']['userInfo'];

        $after_url = \Yii::$app->request->get('after_url','');
        $after_url=base64_decode(str_replace('#','=',$after_url));

        $after_url=Functions::urlContact($after_url,'openid='.$openid);
        return \Yii::$app->response->redirect($after_url);
    }
}