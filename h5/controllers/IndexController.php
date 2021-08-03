<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace h5\controllers;

use common\helpers\commonApi;
use common\helpers\WechatApi;

class IndexController extends WechatController
{
    public function actionIndex()
    {
        $signPackage = (new WechatApi())->signPackage();
       
        if($signPackage['success']){
            $signPackage = $signPackage['data'];
        }
        return $this->render('',['list'=>[],'signPackage'=>$signPackage]);
    }
	public function actionSubform(){
        $content = \Yii::$app->request->post('content','');

        if(empty($content)){
            return commonApi::message('请输入意见反馈内容',false);
        }

        
        return commonApi::message('提交成功',true);
    }

}