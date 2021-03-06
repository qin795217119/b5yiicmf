<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace h5\controllers;

use common\cache\ConfigCache;
use common\helpers\commonApi;
use common\helpers\WechatApi;
use common\models\WechatUsers;
use yii\helpers\Url;
use Yii;

class WechatController extends BaseController
{
    public $wechatInfo;
    public $actInfo;
    public $actService;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function beforeAction($action)
    {
        if(parent::beforeAction($action)){
            $act_id=intval(Yii::$app->request->get('act_id',0));
            if($act_id<1){
                return $this->resError('参数错误');
            }
            $actInfo=$this->actService->info($act_id);
            if(!$actInfo || !$actInfo['status']){
                return $this->resError('活动信息不存在');
            }
            $this->actInfo=$actInfo;
            $appId=ConfigCache::get('wechat_appid');
            if(!$appId){
                return $this->resError('微信公众号参数配置错误');
            }
            $mtype=CONTROLLER_NAME.'_'.$act_id;
            $session_key='wap_openid_'.$mtype;
            $openid=Yii::$app->session->get($session_key,'');
//            $openid='oHwQ-52n1phwDERwoeTWlio_vooE';
            if($openid){
                $wechatInfo=WechatUsers::findOne(['appid'=>$appId,'openid'=>$openid,'type'=>$mtype]);
                if(!$wechatInfo){
                    Yii::$app->session->remove($session_key);
                }else{
                    $this->wechatInfo=$wechatInfo;
                }
            }
            if(!$this->wechatInfo){
                $b5reduri = Yii::$app->request->getReferrer();
                if (!$b5reduri) {
                    $b5reduri = Yii::$app->request->getUrl();
                }
                $b5reduri=commonApi::getDomain($b5reduri);
                $url=Url::toRoute(['public/wxauth','mtype'=>$mtype,'b5reduri'=>$b5reduri],true);
                (new WechatApi())->getOpenId($url);
                return false;
            }
            return true;
        }
        return false;
    }
}