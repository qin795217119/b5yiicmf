<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\helpers;

use common\cache\ConfigCache;
use Yii;

class MaiSend
{
    /**
     * 发送有劲啊
     * @param string $type 发送类型 repass 重置密码   vemail验证邮箱
     * @param array $data 发送数据 包含用户ID（可无），email和name（用户名称）
     * @return bool
     */
    public function sendEmail(string $type, array $data): bool
    {
        if (!$type || !$data || !isset($data['email'])) return false;

        $method = $type . 'Send';
        if (!method_exists($this, $method)) {
            return false;
        }
        $token_data = [
            'id' => $data['id'] ?? 0,
            'email' => $data['email'],
            'time' => time()
        ];

        $token = base64_encode(Yii::$app->security->encryptByKey(json_encode($token_data), 'b5net'));
        $token_data['token'] = $token;
        $token_data['name'] = $data['name'] ?? '';
        return $this->$method($token_data);
    }

    //邮箱验证  和  密码重置  根据需要自己追加 及模板
    private function vemailSend($data)
    {
        return $this->emailSend($data, 'emailVerify-html', '邮箱验证');
    }

    private function repassSend($data)
    {
        return $this->emailSend($data, 'passwordResetToken-html', '修改密码');
    }

    /**
     * 发送邮箱底层方法
     * @param array $data
     * @param string $view
     * @param string $title
     * @return bool
     */
    private function emailSend(array $data, string $view = '', string $title = '')
    {
        if (!$data || !$view) return false;
        $mailer = Yii::$app->mailer;
        $username = ConfigCache::get('sys_email_username');
        $sysName = ConfigCache::get('sys_config_sysname');
        $mailer->setTransport([
            'class' => 'Swift_SmtpTransport',
            'host' => ConfigCache::get('sys_email_host'),
            'username' => $username,//发送者邮箱地址
            'password' => ConfigCache::get('sys_email_password'), //SMTP密码
            'port' => ConfigCache::get('sys_email_port'),
            'encryption' => ConfigCache::get('sys_email_ssl') ? 'ssl' : '',
        ]);
        return $mailer
            ->compose($view, ['data' => $data])
            ->setFrom([$username => $sysName])
            ->setTo($data['email'])
            ->setSubject($sysName . ($title ? '-' . $title : ''))
            ->send();
    }
}
