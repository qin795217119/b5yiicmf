<?php
namespace api\modules\v1\controllers;


use api\components\BaseController;
use common\models\TestChat;
use common\models\TestOnline;
use Yii;

class ChatController extends BaseController
{
    public function actionInit(){
        $ip=Yii::$app->getRequest()->getUserIP();
        $list=TestChat::find()->offset(0)->limit(8)->orderBy('addtime desc')->asArray()->all();
        $data=[
            'ip'=>$ip,
            'list'=>$list?:[]
        ];
        return $this->returnJson()->b5success('',$data);
    }

    public function actionSubdata(){
        $ip=Yii::$app->getRequest()->getUserIP();
        $content=Yii::$app->request->post('msg','');
        if(!$content){
            return $this->returnJson()->b5error('发送内容不能为空');
        }
        $model=new TestChat();
        $data=[
            'ip'=>$ip,
            'content'=>$content,
            'addtime'=>time()
        ];

        if($model->load($data,'') && $model->save()){
            $data['addtime']=date('Y-m-d H:i:s',$data['addtime']);
           return $this->returnJson()->b5success('发送成功',$data);
        }
        return $this->returnJson()->b5error($this->getFerror($model));
    }


    public function actionOnlineadd(){
        $ip=Yii::$app->request->get('ip','');
        $fd=Yii::$app->request->get('fd','');
        if($ip && $fd){
            $info=new TestOnline();
            $info->ip=$ip;
            $info->fd=$fd;
            $info->isrun=1;
            $info->create_time=date('Y-m-d H:i:s',time());
            $info->save(false);
            return true;
        }
        return false;

    }

    public function actionOnlinedel(){
        $fd=Yii::$app->request->get('fd','');
        if($fd){
            $info=TestOnline::find()->where(['fd'=>$fd,'isrun'=>1])->orderBy('id desc')->one();
            if($info){
                $info->isrun=0;
                $info->update_time=date('Y-m-d H:i:s',time());
                $info->save(false);
                return true;
            }
        }
        return false;
    }
}