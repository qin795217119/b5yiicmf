<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------

namespace api\modules\v1\controllers;


use api\components\TraitToken;
use common\helpers\Result;
use yii\base\Controller;


/**
 * 需要进行登录设置token的方法
 * Class ApppubController
 * @package api\modules\v1\controllers
 */
class ApppubController extends Controller
{
    use TraitToken;

    /**
     * 登录设置token
     * @return array
     */
    public function actionLogin(){
        $user_id = 112;
        //调用trait的设置token
        $token = $this->setToken($user_id,'admin','wxsmall');
        if($token){
            return Result::success('登录成功',['token'=>$token]);
        }else{
            return Result::error('登录失败');
        }
   }
}
