<?php
/**
 * 微信支付
 * Created by PhpStorm.
 * User: liheng
 * Date: 2019/11/27
 * Time: 13:58
 */
namespace common\payment;



use common\cache\ConfigCache;
use common\helpers\PayApi;
use Yii;

require_once dirname(dirname(dirname(__FILE__))).'/public/plugins/wxpay/lib/WxPay.Api.php';
require_once dirname(dirname(dirname(__FILE__)))."/public/plugins/wxpay/lib/WxPay.Notify.php";
require_once dirname(dirname(dirname(__FILE__)))."/public/plugins/wxpay/lib/WxPay.Config.Interface.php";

class Wechatpay
{
    public function config(){
        $notify_url=Yii::$app->request->hostInfo.'/api/v1/callback/wechatpay';
        $config = [
            //绑定支付的APPID（必须配置，开户邮件中可查看）
            'AppId' => ConfigCache::get('wechat_appid'),

            //商户号（必须配置，开户邮件中可查看）
            'MCHID'=> ConfigCache::get('wechat_pay_mchid'),

            'HostInfo'=>Yii::$app->request->hostInfo,
            'HostName'=>ConfigCache::get('wechat_pay_hostname'),

            //异步通知地址
            'NotifyUrl' => $notify_url,
            /*
             * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）, 请妥善保管， 避免密钥泄露
             * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
             */
            'Key'=>ConfigCache::get('wechat_pay_key'),

            /*
             * APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置）， 请妥善保管， 避免密钥泄露
             * 获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
             */
            'AppSecret'=>ConfigCache::get('wechat_appsecret'),
        ];
        return $config;
    }
    public function getConfig(){
        return new WxPayConfig($this->config());
    }
    public function pay($orderdata,$scenic=''){
        $config=$this->config();

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = trim($orderdata['order_sn']);

        //订单名称，必填
        $subject = trim($orderdata['order_title']);

        //付款金额，必填
        $total_amount = trim($orderdata['order_money']*100);

        //商品描述，可空
        $body = trim($orderdata['order_remark']);

        //订单ID
        $order_id = trim($orderdata['order_id']);

        $input = new \WxPayUnifiedOrder();
        $input->SetBody($subject);
        $input->SetAttach($body);
        $input->SetOut_trade_no($out_trade_no);
        $input->SetTotal_fee($total_amount);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 3600));
        $input->SetGoods_tag('');
        if($scenic=='app'){
            $input->SetTrade_type("APP");
        }elseif($scenic=='h5'){
            $input->SetTrade_type("MWEB");
            $input->SetScene_info('{"h5_info": {"type":"Wap","wap_url": "'.$config['HostInfo'].'","wap_name": "'.$config['HostName'].'"}}');
            $input->SetSpbill_create_ip(Yii::$app->request->getRemoteIP());
        }elseif ($scenic=='web'){
            $input->SetTrade_type("NATIVE");
        }elseif ($scenic=='jsapi'){
            $input->SetOpenid(isset($orderdata['openid'])?$orderdata['openid']:'');
            $input->SetTrade_type("JSAPI");
        }else{
            return ['status'=>0,'msg'=>'支付场景错误，请在微信外的浏览器打开支付'];
        }

        $input->SetProduct_id($order_id);
        try{
            $config = new WxPayConfig($config);
            $result = \WxPayApi::unifiedOrder($config, $input);
            /**
             *  ["appid"]=>"wx1a25ff265f9f6631"
                ["mch_id"]=> "1587837191"
                ["nonce_str"]=>"hvIwcVScIqjGduN3"
                ["prepay_id"]=>"wx241104272425381f5342ed8b1635633000"
                ["result_code"]=>"SUCCESS"
                ["return_code"]=>"SUCCESS"
                ["return_msg"]=> "OK"
                ["sign"]=>"8C24355C785A878836B4279676BD7A4D26FB1B90DF3A85D62D4A0CA7CDBFC791"
                ["trade_type"]=>"JSAPI"
             */
            if($result && $result['return_code']=='SUCCESS'){
                if($scenic=='app'){
                    $redata=[];
                    $redata['appid'] = $result['appid'];
                    $redata['partnerid'] = $result['mch_id'];
                    $redata['package'] = "Sign=WXPay";
                    $redata['noncestr'] = \WxPayApi::getNonceStr();//生成随机数,下面有生成实例,统一下单接口需要
                    $redata['timestamp'] = time();
                    $redata['prepayid'] = $result['prepay_id'];

                    $redata['result_code'] = "SUCCESS";
                    $redata['return_code'] = "SUCCESS";
                    $redata['return_msg'] = "OK";
                    return ['status'=>1,'msg'=>'创建订单成功','data'=>$redata];
                }elseif ($scenic=='jsapi'){
                    $jsapi = new \WxPayJsApiPay();
                    $jsapi->SetAppid($result["appid"]);
                    $timeStamp = time();
                    $jsapi->SetTimeStamp("$timeStamp");
                    $jsapi->SetNonceStr(\WxPayApi::getNonceStr());
                    $jsapi->SetPackage("prepay_id=" . $result['prepay_id']);
                    $jsapi->SetPaySign($jsapi->MakeSign($config));
                    $parameters = $jsapi->GetValues();
                    /**
                     ["appId"]=>
                    string(18) "wx1a25ff265f9f6631"
                    ["nonceStr"]=>
                    string(32) "8ciei2jyup1bv8tvdlns9jkcvb3lky3y"
                    ["package"]=>
                    string(46) "prepay_id=wx24111417870891dc496c4ced1761411700"
                    ["signType"]=>
                    string(11) "HMAC-SHA256"
                    ["timeStamp"]=>
                    string(10) "1587698057"
                    ["paySign"]=>
                    string(64) "04CBD97EBDA68DC314743EBCC629001E607519B12D5784D23000EB88C5113ED9"
                     */

                    $redata=[];
                    $redata['result_code'] = "SUCCESS";
                    $redata['return_code'] = "SUCCESS";
                    $redata['return_msg'] = "OK";
                    $redata['prepay_id']=$result['prepay_id'];
                    $redata['jsApiParameters']=$parameters;
                    return ['status'=>1,'msg'=>'创建订单成功','data'=>$redata];
                }
                return ['status'=>1,'msg'=>'创建订单成功','data'=>$result];
            }else{
                return ['status'=>0,'msg'=>isset($result['return_msg'])?$result['return_msg']:'调用支付失败'];
            }

        } catch(\Exception $e) {
            return ['status'=>0,'msg'=>'调用支付失败'];
        }
    }

    public function callbackcheck(){
        $config=$this->config();
        $config=new WxPayConfig($config);
        $notify = new PayNotifyCallBack();
        $notify->Handle($config, false);
    }
    private function get_sign($data){
        $config=$this->config();
        ksort($data);
        $str = '';
        foreach ($data as $key => $value) {
            $str .= !$str ? $key . '=' . $value : '&' . $key . '=' . $value;
        }
        $str.='&key='.$config['Key'];
        $sign = strtoupper(md5($str));
        return $sign;
    }
}


class PayNotifyCallBack extends \WxPayNotify
{
//重写回调处理函数
    /**
     * @param WxPayNotifyResults $data 回调解释出的参数
     * @param WxPayConfigInterface $config
     * @param string $msg 如果回调处理失败，可以将错误信息输出到该方法
     * @return true回调出来完成不需要继续回调，false回调处理未完成需要继续回调
     */
    public function NotifyProcess($objData, $config, &$msg)
    {
        $data = $objData->GetValues();
        //TODO 1、进行参数校验
        if(!array_key_exists("return_code", $data)
            ||(array_key_exists("return_code", $data) && $data['return_code'] != "SUCCESS")) {
            //TODO失败,不是支付成功的通知
            //如果有需要可以做失败时候的一些清理处理，并且做一些监控
            $msg = "异常异常";
            return false;
        }
        if(!array_key_exists("out_trade_no", $data) || !array_key_exists("transaction_id", $data) || !array_key_exists("total_fee", $data)){
            $msg = "输入参数不正确";
            return false;
        }

        //TODO 2、进行签名验证
        try {
            $checkResult = $objData->CheckSign($config);
            if($checkResult == false){
                //签名错误
                return false;
            }
        } catch(\Exception $e) {
            return false;
        }

        //TODO 3、处理业务逻辑
        //查询订单，判断订单真实性
        if(!$this->Queryorder($config,$data["transaction_id"],$data['out_trade_no'])){
            $msg = "订单查询失败";
            return false;
        }
        $out_trade_no=$data["out_trade_no"];//商户订单号
        $total_amount=intval($data['total_fee'])/100;//订单金额
        $trade_no = $data['transaction_id']; //微信交易号
        $res= PayApi::orderprocess($out_trade_no,$trade_no,$total_amount);
        if(!$res){
            $msg = "订单处理失败";
            return false;
        }
        return true;
    }
    //查询订单
    public function Queryorder($config,$transaction_id,$out_trade_no)
    {
        $input = new \WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = \WxPayApi::orderQuery($config, $input);
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS" && $result['out_trade_no']==$out_trade_no && array_key_exists('trade_state',$result) && $result['trade_state']=='SUCCESS')
        {
            return true;
        }
        return false;
    }

    /**
     *
     * 回包前的回调方法
     * 业务可以继承该方法，打印日志方便定位
     * @param string $xmlData 返回的xml参数
     *
     **/
    public function LogAfterProcess($xmlData)
    {
        return;
    }


}



/**
 *
 * 该类需要业务自己继承， 该类只是作为deamon使用
 * 实际部署时，请务必保管自己的商户密钥，证书等
 *
 */

class WxPayConfig extends \WxPayConfigInterface
{
    public $config=[];
    public function __construct($config)
    {
        $this->config=$config;
    }

    public function GetAppId()
    {
        return isset($this->config['AppId'])?trim($this->config['AppId']):'';
    }
    public function GetMerchantId()
    {
        return isset($this->config['MCHID'])?trim($this->config['MCHID']):'';
    }

    public function GetNotifyUrl()
    {
        return isset($this->config['NotifyUrl'])?trim($this->config['NotifyUrl']):'';
    }
    public function GetSignType()
    {
//        return "HMAC-SHA256";
        return "MD5";
    }

    public function GetProxy(&$proxyHost, &$proxyPort)
    {
        $proxyHost = "0.0.0.0";
        $proxyPort = 0;
    }

    public function GetReportLevenl()
    {
        return 1;
    }

    public function GetKey()
    {
        return isset($this->config['Key'])?trim($this->config['Key']):'';
    }
    public function GetAppSecret()
    {
        return isset($this->config['AppSecret'])?trim($this->config['AppSecret']):'';
    }

    public function GetSSLCertPath(&$sslCertPath, &$sslKeyPath)
    {
        $sslCertPath = dirname(dirname(dirname(__FILE__))).'/public/plugins/wxpay/cert/apiclient_cert.pem';
        $sslKeyPath = dirname(dirname(dirname(__FILE__))).'/public/plugins/wxpay/cert/apiclient_key.pem';
    }
}
