<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------

namespace api\modules\v1\controllers;

use api\components\BaseController;
use api\components\TraitWechat;
use common\helpers\CryptHelper;
use common\helpers\Result;
use common\helpers\WechatHelper;

class WechatController extends BaseController
{
    /**
     * 引入 actionGetOpenId、actionGetWxUser、actionGetWechatCode
     */
    use TraitWechat;

    // 只获取openid
    //前端直接访问 http://xxxxx.com/api/web/index.php?r=v1/wechat/get-open-id&after_url=xxx
    //after_url需要进行url编码

    // 获取openid并保存详细信息
    //前端直接访问 http://xxxxx.com/api/web/index.php?r=v1/wechat/get-wx-user&after_url=xxx
    //after_url需要进行url编码

    public function actionTest(){
        var_dump($this->request->get());
    }

    /**
     * 获取微信jssdk 签名
     * @return array
     */
    public function actionTestShare(){
        $url = trim($this->request->post('url',''));
        $data= (new WechatHelper())->signPackage($url);
        $crypt = new CryptHelper('1234567890654321','1234567890123456');
        return $this->success('',$crypt->encrypt($data['data']));

    }
}