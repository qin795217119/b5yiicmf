<?php

namespace api\components;

use common\models\AppToken;
use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class BaseController extends Controller
{
    /**
     * 返回JSON结果
     * @param bool $isreturn 是否返回json  false时为在beforeAction中返回
     * @return B5Response
     */
    protected function returnJson($isreturn=true){
        $callback=\Yii::$app->request->get('b5appcallback','');
        if(!$callback){
            $callback=\Yii::$app->request->get('callback','');
        }
        return new B5Response($callback,$isreturn);
    }

    /**
     * 获取并保存token
     * @param $id
     * @param string $type
     * @return array|bool|string
     * @throws \yii\base\Exception
     */
    protected function setToken($id,$type='user'){
        if(!$id) return false;
        $nowTime=time();
        $token=base64_encode($this->createToken($id,$nowTime,$type));
        $info=AppToken::findOne(['user_id'=>$id,'type'=>$type]);
        if(!$info){
            $info=new AppToken();
            $info->user_id=$id;
            $info->type=$type;
        }
        $info->token=$token;
        $info->addtime=$nowTime;
        if($info->save(false)){
            return $token;
        }
        return false;
    }

    /**
     * 解析token
     * @param $token
     * @param string $type
     * @return array|bool|AppToken|null
     */
    protected function getToken($token,$type='user'){
        if(!$token) return false;
        $detoken=base64_decode(trim($token));
        $id_time=\Yii::$app->security->decryptByKey($detoken,$type);
        if(!$id_time || !strpos($id_time,'_')) return false;
        list($id,$time)=explode('_',$id_time,2);
        if(!$id || !$time) return false;
        if($time>time()) return false;
        $info=AppToken::findOne(['token'=>$token]);
        if(!$info || $info->type!=$type || $info->user_id!=$id || $info->addtime!=$time) return false;
        $info=$info->toArray();
        return $info;
    }

    /**
     * 创建token
     * @param $id
     * @param $nowTime
     * @param $type
     * @return array
     * @throws \yii\base\Exception
     */
    private function createToken($id,$nowTime,$type){
        $token=\Yii::$app->security->encryptByKey($id.'_'.$nowTime,$type);
        $has=AppToken::findOne(['token'=>$token]);
        if($has){
            return $this->createToken($id,$nowTime,$type);
        }
        return $token;
    }

}
