<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// | META:短信验证码类
// +----------------------------------------------------------------------
namespace common\components\jobs;

use common\helpers\MailApi;
use yii\base\BaseObject;
use yii\helpers\Console;
use yii\queue\JobInterface;

class EmailJob extends BaseObject implements JobInterface
{
    public $id;//用户ID获取其他标识
    public $name;//用户名称
    public $email;//邮箱地址
    public $type;//发送类型
    public function execute($queue)
    {
        if($this->type){
            $data=[
                'id' => $this->id?:0,
                'name' => $this->name?:'',
                'email' => $this->email?:''
            ];
            $tips = Console::ansiFormat("开始发送邮件：".$this->email,[Console::FG_YELLOW]);
            Console::output("{$tips}");
            (new MailApi())->sendEmail($this->type,$data);
        }

    }
}