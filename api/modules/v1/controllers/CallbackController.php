<?php
/**
 * 支付异步通知页面
 * Created by PhpStorm.
 * User: lenovo
 * Date: 2019/8/14
 * Time: 14:18
 */

namespace api\modules\v1\controllers;

use api\components\BaseController;
use common\payment\Wechatpay;
use Yii;

class CallbackController extends BaseController
{

    /**
     * 未支付异步回调
     * @throws \Exception
     */
    public function actionWechatpay(){
        (new Wechatpay())->callbackcheck();
    }


}