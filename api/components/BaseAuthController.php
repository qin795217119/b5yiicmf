<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace api\components;

class BaseAuthController extends BaseController
{
    public $token='';
    public $tokeninfo='';
    public function beforeAction($action)
    {
        if(parent::beforeAction($action)){
            $this->token=\Yii::$app->request->post('token','');
            if(!$this->token) $this->token=\Yii::$app->request->get('token','');
            $this->tokeninfo=$this->getToken($this->token);
            if(!$this->tokeninfo){
                return $this->returnJson(false)->b5error('登录失效',305);
            }
            return true;
        }
        return false;
    }
}
