<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\helpers\plugins;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


//安装 composer require guzzlehttp/guzzle
//使用
//创建客户端  $client = new Client([
//              'base_uri' => $this->baseUrl[$park],
//              'timeout'  => 3.0
//          ]);

//application/json请求  $client->request('POST',$url, ['json' => [数据array]]);

//application/x-www-form-urlencoded请求  $client->request('POST',$url,['form_params' => [数据array]]);

//设置headers  $client->request('POST',$url,[
//                'headers' => [
//                    'Authorization' => 'APPCODE '.$this->app_code
//                ],
//                'form_params' => $data
//            ]);
class Kuai100
{
    /**
     * @var string 授权码
     */
    private string $customer = '';

    private string $key = '';


    /**
     * @var string 快递公司
     */
    private string $ship_com = '';
    /**
     * @var string 快递单号
     */
    private string $ship_sn = '';

    /**
     * @var string 错误信息
     */
    private string $error ='';

    /**
     * 参数
     * @var array
     */
    private array $params = [];

    /**
     * 查询快递
     * @return array|bool|mixed
     */
    public function query(){
        if(!$this->checkParams()) return false;
        $sign = $this->makeSign();
        try {
            $client = new Client();
            $response = $client->request('POST','https://poll.kuaidi100.com/poll/query.do',['form_params' => [
                'customer' => $this->customer,
                'sign' => $sign,
                'param' => $this->params
            ]]);
            return $this->responseCheck($response);
        } catch (GuzzleException $exception){
            return $this->addError('快递查询错误:'.$exception->getMessage());
        }
    }
    /**
     * 配置参数检测
     * @return bool
     */
    private function checkParams(){
        if(!$this->customer || !$this->key) return $this->addError('授权码和key为空');
        if(!$this->ship_sn) return $this->addError('物流单号为空');
        $ship_com = $this->autoGetCom();
        if(!$ship_com) return false;
        $param = [
            'com'=>strtolower($ship_com[0]['comCode']),
            'num'=>trim($this->ship_sn),
            'phone'=>'',
            'from'=>'',
            'to'=>'',
            'resultv2'=>'4',
            'show'=>'0',
            'order'=>'desc'
        ];
        $this->params = json_encode($param, JSON_UNESCAPED_UNICODE);
        return true;
    }

    /**
     * 自动获取物流公司
     * @return array|bool|mixed
     */
    private function autoGetCom(){
        try {
            $client = new Client();
            $url = 'http://www.kuaidi100.com/autonumber/auto?num='.$this->ship_sn.'&key='.$this->key;
            $response = $client->request('GET',$url);
            return $this->responseCheck($response,false);
        }catch (GuzzleException $exception){
            return $this->addError('快递查询错误:'.$exception->getMessage());
        }
    }

    /**
     * 相应处理
     * @param $response
     * @param bool $isData
     * @return array|bool|mixed
     */
    private function responseCheck($response,$isData = true){
        //返回状态判断
        if(!$response) return $this->addError('快递查询错误:无响应');
        if ($response->getStatusCode() != 200) return $this->addError('快递查询错误:'.$response->getStatusCode().' - '.$response->getReasonPhrase());

        //获取返回内容并判断
        $content = json_decode($response->getBody()->getContents(),true);
        if(!$content) return $this->addError('快递查询错误:无返回值');
        if(isset($content['result']) && !$content['result']) return $this->addError('快递查询错误:'.$content['message']);
        return $isData?($content['data']??[]):$content;
    }

    /**
     * 生成签名
     * @return string
     */
    private function makeSign():string
    {
        $string = $this->params;
        //签名步骤二：在string后加入KEY
        $string = $string . $this->key . $this->customer;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        return strtoupper($string);
    }
    /**
     * @param string $ship_com
     */
    public function setShipCom(string $ship_com): void
    {
        $this->ship_com = $ship_com;
    }

    /**
     * @param string $ship_sn
     */
    public function setShipSn(string $ship_sn): void
    {
        $this->ship_sn = $ship_sn;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * 设置错误信息
     * @param $error
     * @return bool
     */
    private function addError($error): bool
    {
        $this->error = $error;
        return false;
    }
}