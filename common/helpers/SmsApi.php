<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// | META:短信验证码类
// +----------------------------------------------------------------------
namespace common\helpers;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use common\cache\ConfigCache;
use common\models\Smscode;

class SmsApi
{
    /**
     * 发送短信
     * @param $mobile
     * @param int $type 类型 1注册 2登录 3找回密码
     * @param string $os 短信服务商 ali  juhe
     * @return array
     */
    public function sendcode($mobile, $type = 0, $os = 'ali')
    {
        if ($type == 1) {
            //注册 验证手机号未注册
        } elseif ($type == 2 || $type == 3) {
            //登录 验证手机号已注册
        } else {
            return commonApi::message('短信发送失败:1', false);
        }
        $code = mt_rand(100000, 999999);
        $method = $os . 'send';
        if (!method_exists($this, $method)) {
            return commonApi::message('短信服务未开启', false);
        }

        //一分钟内禁止相同操作的发送
        $info = Smscode::find()->where(['mobile' => $mobile, 'type' => $type])->orderBy('id desc')->asArray()->one();
        if ($info && $info['status'] == 0) {
            $lasTime = strtotime($info['create_time']);
            if ($lasTime > time() - 60) {
                return commonApi::message('操作太频繁，请稍后再试', false);
            }
        }
        $result = $this->$method($mobile, $code);
        if (!$result || !$result['success']) {
            return commonApi::message('短信发送失败', false);
        }
        $model = new Smscode();
        $model->mobile = $model;
        $model->code = $code;
        $model->os = $os;
        $model->type = $type;
        $model->status = 0;
        if($model->save(false)){
            return commonApi::message('发送成功',true);
        }else{
            return commonApi::message('发送失败',false);
        }
    }

    /**
     * 验证码 验证
     * @param $mobile
     * @param $code
     * @param int $type
     * @return array
     */
    public function checkcode($mobile, $code, $type = 0)
    {
        if (!ValidateApi::isMobilePhone($mobile)) {
            return commonApi::message('手机号码错误', false);
        }
        if (empty($code)) {
            return commonApi::message('验证码错误', false);
        }
        $info = Smscode::find()->where(['mobile' => $mobile,'type' => $type])->orderBy('id desc')->one();
        if (empty($info)) {
            return commonApi::message('验证码信息错误', false);
        }
        if ($info['status']) {
            return commonApi::message('验证码已失效', false);
        }
        if ($info['code'] != $code) {
            return commonApi::message('验证码错误', false);
        }
        $lasttime = time() - 600;
        $addtime = strtotime($info['create_time']);
        if ($addtime < $lasttime) {
            return commonApi::message('验证码已失效', false);
        }
        $info->status = 1;
        $info->save(false);
        return commonApi::message('验证码正确', true);
    }

    /**
     * 阿里云短信 发送验证码
     * @param $mobile
     * @param $code
     * @return array
     * @throws \AlibabaCloud\Client\Exception\ClientException
     * @throws \AlibabaCloud\Client\Exception\ServerException
     */
    private function alisend($mobile, $code)
    {
        if (empty($mobile) || !ValidateApi::isMobilePhone($mobile)) {
            return commonApi::message('手机号码格式错误', false);
        }
        if (empty($code)) {
            return commonApi::message('验证码不能为空', false);
        }
        $accessKeyId = ConfigCache::get('sms_ali_key');
        $accessSecret = ConfigCache::get('sms_ali_secret');
        $signName = ConfigCache::get('sms_ali_signname');
        $tempId = ConfigCache::get('sms_ali_temp');
        if (empty($accessKeyId) || empty($accessSecret) || empty($signName) || empty($tempId)) {
            return commonApi::message('短信服务配置错误', false);
        }
        AlibabaCloud::accessKeyClient($accessKeyId, $accessSecret)
            ->regionId('cn-hangzhou')
            ->asDefaultClient();
        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => $mobile,
                        'SignName' => $signName,
                        'TemplateCode' => $tempId,
                        'TemplateParam' => "{code:" . $code . "}",
                    ],
                ])
                ->request();
            $result = $result->toArray();
            if ($result && isset($result['Message'])) {
                if ($result['Message'] == 'OK') {
                    return commonApi::message('发送成功', true);
                } else {
                    return commonApi::message($result['Message'], false);
                }
            }

        } catch (ClientException $exception) {

        } catch (ServerException $exception) {

        }
        return commonApi::message('发送失败', false);
    }

    /**
     * 聚合短信-发送验证码
     * @param $mobile
     * @param $code
     * @return array
     */
    private function juhesend($mobile, $code)
    {
        if (empty($mobile) || !ValidateApi::is_mobile_phone($mobile)) {
            return commonApi::message('手机号码格式错误', false);
        }
        if (empty($code)) {
            return commonApi::message('验证码不能为空', false);
        }
        $url = 'http://v.juhe.cn/sms/send';
        $appkey = ConfigCache::get('sms_juhe_appkey');
        $tplid = ConfigCache::get('sms_juhe_temp');
        if (empty($appkey) || empty($tplid)) {
            return commonApi::message('短信服务配置错误', false);
        }
        $params = array(
            'key' => $appkey, //您申请的APPKEY
            'mobile' => $mobile, //接受短信的用户手机号码
            'tpl_id' => $tplid, //您申请的短信模板ID，根据实际情况修改
            'tpl_value' => '#code#=' . $code //您设置的模板变量，根据实际情况修改
        );
        $content = commonApi::b5curl_post($url, $params); //请求发送短信
        if ($content) {
            $result = json_decode($content, true);
            $error_code = $result['error_code'];
            if ($error_code == 0) {
                return commonApi::message('发送成功', true);
            }
            return commonApi::message($result['reason'], false);
        }
        return commonApi::message('发送失败', false);
    }
}
