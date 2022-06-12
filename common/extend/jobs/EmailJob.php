<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\extend\jobs;

use common\helpers\MaiSend;
use yii\base\BaseObject;
use yii\helpers\Console;
use yii\queue\JobInterface;

class EmailJob extends BaseObject implements JobInterface
{
    public $id = '';//用户ID获取其他标识
    public string $name = '';//用户名称
    public string $email = '';//邮箱地址
    public string $type = '';//发送类型
    public function execute($queue)
    {
        //手动执行和定时执行是有区别的
        //定义执行注意console中的配置，例如发送邮件中调用urlManager->createAbsoluteUrl需要在console\common\main.php中配置
        if($this->type){
            $data=[
                'id' => $this->id?:0,
                'name' => $this->name?:'',
                'email' => $this->email?:''
            ];
            $tips = Console::ansiFormat("开始发送邮件：".$this->email,[Console::FG_YELLOW]);
            Console::output("{$tips}");
            Console::output(json_encode($data));
            $result = (new MaiSend())->sendEmail($this->type,$data);
            Console::output("结果：".$result?'ok':'fail');
        }

    }
}