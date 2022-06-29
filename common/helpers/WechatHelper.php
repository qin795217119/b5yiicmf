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

class WechatHelper
{
    /**
     * 微信授权state
     * @var string
     */
    protected string $state = '';

    /**
     * 是否获取用户信息
     * @var bool
     */
    protected bool $user_info = true;

    /**
     * 微信公众号 appID
     */
    protected $appid = '';

    /**
     * 微信公众号 appSecret
     */
    protected $secret = '';

    /**
     * 微信用户表
     * @var string
     */
    protected string $user_table = 'b5net_wechat_users';

    /**
     * 微信全局access_token标
     * @var string
     */
    protected string $access_table = 'b5net_wechat_access';


    public function __construct(bool $user_info = true,string $state = 'b5net')
    {
        $this->user_info = $user_info;

        $this->state = $state;

        $this->appid = ConfigCache::get('wechat_appid', '');

        $this->secret = ConfigCache::get('wechat_appsecret', '');
    }
    /**
     * 获取小程序openid
     * @param string $code
     * @return false|mixed
     */
    public function getSmallOpenId(string $code = '')
    {
        $wechat_url = "https://api.weixin.qq.com/sns/jscode2session?appid=".$this->appid."&secret=".$this->secret."&js_code=".$code."&grant_type=authorization_code";
        $res = Functions::b5curl_get($wechat_url);
        if (empty($res)) {
            return Result::error('请求失败');
        }
        $res = json_decode($res, true);
        if (empty($res) || !is_array($res)) {
            return Result::error('请求失败1');
        }
        if (!isset($res['openid']) || empty($res['openid'])) {
            return Result::error($res['errmsg']??'请求失败2');
        }
        return Result::success('',$res);
    }

    /**
     * 获取手机号码，最新
     * @param string $code
     * @return array
     */
    public function getSmallPhone(string $code = ''){
        if(!$code) return Result::error('请求参数错误');
        $accessTokenResult = $this->global_getAccessToken();
        if (!$accessTokenResult['success']) {
            return $accessTokenResult;
        }

        $wechat_url = "https://api.weixin.qq.com/wxa/business/getuserphonenumber?access_token=".$accessTokenResult['data']['access_token'];
        $res = Functions::b5curl_post($wechat_url,json_encode(['code'=>$code]));
        if (empty($res)) {
            return Result::error('请求返回值错误');
        }
        $res = json_decode($res, true);
        if (empty($res) || !is_array($res)) {
            return Result::error('请求返回值错误1');
        }
        if (!isset($res['phone_info']) || empty($res['phone_info'])) {
            return Result::error($res['errmsg']??'获取失败');
        }
        return Result::success('',$res['phone_info']);
    }

    /**
     * 获取公众号用户信息
     * @param string $auth_url
     * @return \yii\console\Response|\yii\web\Response
     */
    public function getOpenId(string $auth_url = '')
    {
        $scope = 'snsapi_base';
        if ($this->user_info) {
            $scope = 'snsapi_userinfo';
        }
        $wechat_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->appid . "&redirect_uri=" . urlencode($auth_url) . "&response_type=code&scope=" . $scope . "&state=" . $this->state . "#wechat_redirect";
        return Yii::$app->response->redirect($wechat_url);
    }

    /**
     * 微信授权获取用户信息
     * @return array
     */
    public function getUserInfo()
    {
        $input = Yii::$app->request->get();
        $code = $input['code'] ?? '';
        $state = $input['state'] ?? '';
        $mtype = $input['mtype'] ?? '';//可以用来区分不同的应用

        if (empty($code) || $state != $this->state) {
            return Result::error('授权参数错误');
        }
        $accessTokenResult = $this->auth_getAccessToken($code);
        if (!$accessTokenResult['success']) {
            return $accessTokenResult;
        }
        if (!$this->user_info) {
            return Result::success('获取OpenId成功',['openid'=>$accessTokenResult['data']['openid'],'mtype'=>$mtype]);
        }

        //查看数据库中是否有该openid的为微信信息  不存在插入
        $userInfo = (new \yii\db\Query())->from($this->user_table)->where(['openid' => $accessTokenResult['data']['openid'], 'appid' => $this->appid, 'type' => $mtype])->one();
        if (!$userInfo) {
            $getResult = $this->auth_getUserinfo($accessTokenResult['data']['access_token'], $accessTokenResult['data']['openid']);
            if (!$getResult['success']) {
                return $getResult;
            }
            $userInfo = [
                'openid' => $accessTokenResult['data']['openid'],
                'appid' => $this->appid,
                'nickname' => $getResult['data']['nickname'],
                'sex' => $getResult['data']['sex'],
                'headimg' => $getResult['data']['headimgurl'],
                'province' => $getResult['data']['province'],
                'city' => $getResult['data']['city'],
                'country' => $getResult['data']['country'],
                'type' => $mtype,
                'create_time'=>date('Y-m-d H:i:s'),
                'update_time'=>date('Y-m-d H:i:s'),
            ];
            try {
                $result = \Yii::$app->db->createCommand()->insert($this->user_table, $userInfo)->execute();
                if($result){
                    $userInfo['id'] = \Yii::$app->db->getLastInsertID();
                }
            } catch (\yii\db\Exception $e) {
                $result = false;
            }
            if (!$result) {
                return Result::error('保存信息失败');
            }
        }
        return Result::success('获取成功', ['openid'=>$accessTokenResult['data']['openid'],'userInfo' => $userInfo, 'mtype' => $mtype]);
    }

    /**
     * 获取JSSDK的签名信息
     * @param string $url
     * @return array
     */
    public function signPackage($url = ''): array
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
        $string = "jsapi_ticket=" . $jsapiTicketResult['data']['ticket'] . "&noncestr=" . $nonceStr . "&timestamp=" . $timestamp . "&url=" . $url;
        $signature = sha1($string);
        $signPackage = array(
            "appId" => $this->appid,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return Result::success('获取成功', $signPackage);
    }


    /**
     * 微信授权-获取用户信息的 access_token和openid
     * @param $code
     * @return array
     */
    private function auth_getAccessToken($code)
    {
        if (empty($this->appid) || empty($this->secret)) {
            return Result::error('微信公众号配置错误');
        }
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' . $this->appid . '&secret=' . $this->secret . '&code=' . $code . '&grant_type=authorization_code';
        $res = Functions::b5curl_get($url);
        if (empty($res)) {
            return Result::error('获取AccessToken失败：1');
        }
        $res = json_decode($res, true);
        if (empty($res) || !is_array($res)) {
            return Result::error('获取AccessToken失败：2');
        }
        if (empty($res['access_token']) || empty($res['openid'])) {
            return Result::error('获取AccessToken失败');
        }
        return Result::success('获取AccessToken成功', $res);
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
            return Result::error('获取用户信息参数错误');
        }
        $url = 'https://api.weixin.qq.com/sns/userinfo?access_token=' . $access_token . '&openid=' . $openid . '&lang=zh_CN';
        $res = Functions::b5curl_get($url);
        if (empty($res)) {
            return Result::error('获取用户信息失败：1');
        }

        $res = json_decode($res, true);
        if (empty($res) || !is_array($res)) {
            return Result::error('获取用户信息失败：2');
        }
        if (isset($res['errcode']) || empty($res['openid'])) {
            return Result::error('获取用户信息失败：2');
        }
        return Result::success('获取用户信息成功', $res);
    }

    /**
     * 获取加密随机字符串
     * @param int $length
     * @return string
     */
    private function createNonceStr(int $length = 16): string
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
    private function getJsApiTicket(): array
    {
        if (empty($this->appid)) {
            return Result::error('微信配置错误');
        }

        $info = (new \yii\db\Query())->from($this->access_table)->where(['appid' => $this->appid])->one();
        $lastTime = time() - 7000;
        if (empty($info) || $info['jsapi_ticket_add'] < $lastTime || empty($info['jsapi_ticket'])) {
            $accessTokenResult = $this->global_getAccessToken($info ?: false);
            if (!$accessTokenResult['success']) {
                return $accessTokenResult;
            }

            //通过微信接口获取
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=" . $accessTokenResult['data']['access_token'];

            //返回值验证
            $res = Functions::b5curl_get($url);
            if (empty($res)) {
                return Result::error('获取jsapi_ticket失败：1');
            }
            $res = json_decode($res, true);
            if (empty($res) || !is_array($res)) {
                return Result::error('获取jsapi_ticket失败：2');
            }
            if (!isset($res['ticket']) || !$res['ticket']) {
                return Result::error('获取jsapi_ticket失败: 3');
            }

            //保存信息
            $saveData = ['jsapi_ticket_add' => time(), 'jsapi_ticket' => $res['ticket']];
            try {
                $result = \Yii::$app->db->createCommand()->update($this->access_table, $saveData, "appid = '" . $this->appid."'")->execute();
            } catch (\yii\db\Exception $e) {
                $result = false;
            }
            if (!$result) {
                return Result::error('保存jsapi_ticket失败');
            }
            $ticket = $res['ticket'];
        } else {
            $ticket = $info['jsapi_ticket'];
        }
        return Result::success('获取成功', ['ticket'=>$ticket]);
    }

    /**
     * 获取全局access_token
     * @param null $info
     * @return array
     */
    private function global_getAccessToken($info = null)
    {
        if (empty($this->appid) || empty($this->secret)) {
            return Result::error('微信配置错误');
        }
        if (is_null($info)) {
            $info = (new \yii\db\Query())->from($this->access_table)->where(['appid' => $this->appid])->one();
        }

        $lastTime = time() - 7000;
        if (empty($info) || empty($info['access_token']) || $info['access_token_add'] < $lastTime) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->secret";

            //返回值验证
            $res = Functions::b5curl_get($url);
            if (empty($res)) {
                return Result::error('获取AccessToken失败：1');
            }
            $res = json_decode($res, true);
            if (empty($res) || !is_array($res)) {
                return Result::error('获取AccessToken失败：2');
            }
            if (!isset($res['access_token']) || !$res['access_token']) {
                return Result::error('获取AccessToken失败：3');
            }


            //保存信息
            $saveData = ['access_token_add' => time(), 'access_token' => $res['access_token']];
            if ($info) {
                try {
                    $result = \Yii::$app->db->createCommand()->update($this->access_table, $saveData, "id = " . $info['id'])->execute();
                } catch (\yii\db\Exception $e) {
                    $result = false;
                }
            } else {
                $saveData['appid'] = $this->appid;
                try {
                    $result = \Yii::$app->db->createCommand()->insert($this->access_table, $saveData)->execute();
                } catch (\yii\db\Exception $e) {
                    $result = false;
                }
            }
            if (!$result) {
                return Result::error('保存access_token失败');
            }
            $access_token = $res['access_token'];
        } else {
            $access_token = $info['access_token'];
        }
        return Result::success('获取成功', ['access_token'=>$access_token]);
    }

    /**
     * 检验数据的真实性，并且获取解密后的明文.
     * @param $sessionKey string 用户在小程序登录后获取的会话密钥
     * @param $encryptedData string 加密的用户数据
     * @param $iv string 与用户数据一同返回的初始向量
     * @param $data string 解密后的原文
     * @return array
     */
    public function decryptData($sessionKey, $encryptedData, $iv, &$data )
    {
        if (strlen($sessionKey) != 24)  return Result::error('sessionKey 非法');
        $aesKey=base64_decode($sessionKey);


        if (strlen($iv) != 24)  return Result::error('iv 非法');
        $aesIV=base64_decode($iv);

        $aesCipher=base64_decode($encryptedData);

        $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);

        $dataObj=json_decode( $result );
        if( $dataObj  == NULL )  return Result::error('解密失败');
        if( $dataObj->watermark->appid != $this->appid ) return Result::error('解密失败');
        $data = $result;
        return Result::success();
    }
}
