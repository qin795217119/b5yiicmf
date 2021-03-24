<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// | META: 微信公号号常用操作
// +----------------------------------------------------------------------
namespace common\helpers;

use common\cache\ConfigCache;
use common\services\WechatAccessService;
use common\services\WechatUsersService;
use Yii;

class WechatApi
{
    public $state = '';
    public $is_info = true;//是否获取用户信息
    public $appid = '';
    public $secret = '';

    public function __construct()
    {
        $this->appid = ConfigCache::get('wechat_appid');
        $this->secret = ConfigCache::get('wechat_appsecret');
    }

    /**
     * 微信授权获取用户信息
     * @return array
     */
    public function authInfo()
    {
        $input = Yii::$app->request->get();
        $code = $input['code'] ?? '';
        $state = $input['state'] ?? '';
        if (empty($code) || $state != $this->state) {
            return commonApi::message('授权参数错误', false);
        }
        $accessTokenResult = $this->auth_getAccessToken($code);
        if (!$accessTokenResult['success']) {
            return $accessTokenResult;
        }
        if (!$this->is_info) {
            return $accessTokenResult;
        }

        //查看数据库中是否有该openid的为微信信息  不存在插入
        $userService = new WechatUsersService();
        $usersInfo = $userService->info([['openid' => $accessTokenResult['data']['openid']]], true);
        if (!$usersInfo) {
            $getResult = $this->auth_getUserinfo($accessTokenResult['data']['access_token'], $accessTokenResult['data']['openid']);
            if (!$getResult['success']) {
                return $getResult;
            }
            $usersInfo = [
                'openid' => $accessTokenResult['data']['openid'],
                'appid' => $this->appid,
                'nickname' => $getResult['data']['nickname'],
                'sex' => $getResult['data']['sex'],
                'headimg' => $getResult['data']['headimgurl'],
                'province' => $getResult['data']['province'],
                'city' => $getResult['data']['city'],
                'country' => $getResult['data']['country'],
            ];
            $res = $userService->add($usersInfo, '', '用户信息保存');
            if (!$res['success']) {
                return $res;
            }
        }
        return commonApi::message('获取成功', true, $usersInfo);
    }

    /**
     * 获取JSSDK的签名信息
     * @param string $url
     * @return array
     */
    public function signPackage($url = '')
    {
        $jsapiTicketResult = $this->getJsApiTicket();
        if (!$jsapiTicketResult['success']) {
            return $jsapiTicketResult;
        }
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $domain = $_SERVER['HTTP_HOST'];
        $url = $url ? $url : "$protocol$domain$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=" . $jsapiTicketResult['data'] . "&noncestr=" . $nonceStr . "&timestamp=" . $timestamp . "&url=" . $url;
        $signature = sha1($string);
        $signPackage = array(
            "appId" => $this->appid,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return commonApi::message('获取成功', true, $signPackage);
    }


    /**
     * 微信授权-获取用户信息的 access_token和openid
     * @param $code
     * @return array
     */
    private function auth_getAccessToken($code)
    {
        if (empty($this->appid) || empty($this->secret)) {
            return commonApi::message('微信公众号配置错误', false);
        }
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->appid . '&secret=' . $this->secret . '&code=' . $code . '&grant_type=authorization_code';
        $reurl = commonApi::b5curl_get($url);
        if (empty($reurl)) {
            return commonApi::message('获取AccessToken失败：1', false);
        }
        $rearr = json_decode($reurl, true);
        if (empty($rearr) || !is_array($rearr)) {
            return commonApi::message('获取AccessToken失败：2', false);
        }
        if (empty($rearr['access_token']) || empty($rearr['openid'])) {
            return commonApi::message('获取AccessToken失败', false);
        }
        return commonApi::message('获取AccessToken成功', true, $rearr);
    }

    /**
     * 微信授权-根据accesstoken和openid获取用户详细信息
     * @param $access_token
     * @param $openid
     * @return array
     */
    public function auth_getUserinfo($access_token, $openid)
    {
        if (empty($access_token) || empty($openid)) {
            return commonApi::message('获取用户信息参数错误', false);
        }
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
        $reurl = commonApi::b5curl_get($url);
        if (empty($reurl)) {
            return commonApi::message('获取用户信息失败：1', false);
        }
        $rearr = json_decode($reurl, true);
        if (empty($rearr) || !is_array($rearr)) {
            return commonApi::message('获取用户信息失败：2', false);
        }
        if ($rearr['errcode'] || empty($rearr['openid'])) {
            return commonApi::message('获取用户信息失败：2', false);
        }
        return commonApi::message('获取用户信息成功', true, $rearr);
    }

    /**
     * 获取加密随机字符串
     * @param int $length
     * @return string
     */
    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 获取jsApi的ticket
     * @return array
     */
    private function getJsApiTicket()
    {
        $service = new WechatAccessService();
        if (empty($this->appid)) {
            return commonApi::message('微信配置错误', false);
        }
        $info = $service->info($this->appid, true);
        $lasttime = time() - 7000;
        if (empty($info) || $info['jsapi_ticket_add'] < $lasttime || empty($info['jsapi_ticket'])) {
            $accessTokenResult = $this->global_getAccessToken($info);
            if (!$accessTokenResult['success']) {
                return $accessTokenResult;
            }
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=" . $accessTokenResult['data'];
            $res = commonApi::b5curl_get($url);
            if (empty($res)) {
                return commonApi::message('获取jsapi_ticket失败：1', false);
            }
            $res = json_decode($res, true);
            if (empty($res) || !is_array($res)) {
                return commonApi::message('获取jsapi_ticket失败：2', false);
            }
            if (isset($res['ticket']) && $res['ticket']) {
                $saveData = [
                    'jsapi_ticket_add' => time(),
                    'jsapi_ticket' => $res['ticket'],
                    'appid' => $this->appid
                ];
                $res = (new WechatAccessService())->edit($saveData);
                if (!$res['success']) {
                    return commonApi::message('保存jsapi_ticket失败', false);
                }
                $ticket = $res['ticket'];
            } else {
                return commonApi::message('获取jsapi_ticket失败', false);
            }
        } else {
            $ticket = $info['jsapi_ticket'];
        }
        return commonApi::message('获取成功', true, $ticket);
    }

    /**
     * 获取全局access_token
     * @param null $info
     * @return array
     */
    private function global_getAccessToken($info = null)
    {
        if (empty($appid) || empty($secret)) {
            return commonApi::message('微信配置错误', false);
        }
        if (is_null($info)) {
            $info = (new WechatAccessService())->info($appid, true);
        }
        $lasttime = time() - 7000;
        if (empty($info) || empty($info['access_token']) || $info['access_token_add'] < $lasttime) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->secret";
            $res = commonApi::b5curl_get($url);
            if (empty($res)) {
                return commonApi::message('获取AccessToken失败：1', false);
            }
            $res = json_decode($res, true);
            if (empty($res) || !is_array($res)) {
                return commonApi::message('获取AccessToken失败：2', false);
            }
            if (isset($res['access_token']) && $res['access_token']) {
                $saveData = [
                    'access_token_add' => time(),
                    'access_token' => $res['access_token'],
                    'appid' => $this->appid
                ];
                if (empty($info)) {
                    $res = (new WechatAccessService())->add($saveData);
                } else {
                    $res = (new WechatAccessService())->edit($saveData);
                }
                if (!$res['success']) {
                    return commonApi::message('保存access_token失败', false);
                }
                $access_token = $res['access_token'];
            } else {
                return commonApi::message('获取AccessToken失败', false);
            }
        } else {
            $access_token = $info['access_token'];
        }
        return commonApi::message('获取成功', true, $access_token);
    }
}
