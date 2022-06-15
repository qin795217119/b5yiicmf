<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------

namespace api\modules\v1\controllers;

use api\components\BaseController;
use api\components\TraitToken;
use common\helpers\WechatHelper;

class WxsmallController extends BaseController
{
    /**
     * 引入 生成token
     */
    use TraitToken;


    public function actionLogin(){
        $code = $this->request->post('code', '');
        $nickname = $this->request->post('nickname', '');
        $avatar = $this->request->post('avatar', '');
        if (!$code) return $this->error('授权code错误');

        $wechat = new WechatHelper();
        $openResult = $wechat->getSmallOpenId($code);
        if (!$openResult['success']) return $this->error($openResult['msg']);
        $openid = $openResult['data']['openid'];

        // todo 处理查询保存操作
    }

    public function actionGetphone(){
        $code = $this->request->post('code','');
        $openid = $this->request->post('openid','');
        if(!$code || !$openid){
            return $this->error('参数错误');
        }
        $wechat = new WechatHelper();
        $res = $wechat->getSmallPhone($code);
        if(!$res['success']){
            return $this->error($res['msg']);
        }
        $phone = $res['data']['phoneNumber'];

        //todo 处理查询保存操作
    }
}