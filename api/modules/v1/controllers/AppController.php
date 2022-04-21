<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------

namespace api\modules\v1\controllers;


use common\helpers\Result;
use yii\base\Controller;


/**
 * 需要进行接口检测的示例
 * Class AppController
 * @package api\modules\v1\controllers
 */
class AppController extends Controller
{
    public function behaviors():array
    {
        return [
            //登录判断
            'FilterLogin'=>[
                'class' => \api\components\FilterLogin::class,
                'type'=>'app'
            ]
        ];
    }

    public function actionIndex(){

        //获取token记录信息
        $token = \Yii::$app->request->getBodyParam('__token');
        /**
         * array(4) {
                ["token"]=>
                string(32) "eb5a1e900eb052c06ad251d00f2a1d04"
                ["type"]=>
                string(3) "app"
                ["user_id"]=>
                string(3) "112"
                ["exp_time"]=>
                string(10) "1651123493"
            }
         */
       return Result::success('asdsada');
   }
}
