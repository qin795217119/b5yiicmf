<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------

namespace api\modules\v1\controllers;

use api\components\TraitWechat;
use common\helpers\WechatHelper;
use yii\base\Controller;

class WechatController extends Controller
{
    /**
     * 引入 getopenid和getwechatcode
     */
    use TraitWechat;


    public function actionTest(){
        var_dump(\Yii::$app->request->get());
    }
    //前端直接访问 http://xxxxx.com/api/web/index.php?r=v1/wechat/getopenid&after_url=xxx
    //after_url需要进行url编码

    public function actionTestshare(){
        return (new WechatHelper())->signPackage();
    }
}