<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\helpers;

/**
 * AES/DES加密
 *  $crypt = new CryptHelper('1234567890654321','1234567890123456');
    $code = $crypt->encrypt('123');

 */
class CryptHelper
{
    /**
     * 加密模式
     * @var string
     */
    public $cipher = 'AES-128-CBC';

    /**
     * 密钥
     * @var string
     */
    public $secret_key = '';

    /**
     * 偏移量 CBC需要iv
     * @var string
     */
    public $iv = '';

    /**
     * @var bool 加密解密前是否使用base64编码
     * 前端crypto-js 都是进行了base64加密
     */
    public $base64 = true;

    /**
     * 补位方式
     * 0 默认
     * OPENSSL_RAW_DATA = 1  对应PKCS7
     * OPENSSL_ZERO_PADDING = 2 使用0填充
     * OPENSSL_NO_PADDING = 3 不填充，需要手动填充
     * @var int
     */
    public $pad = 1;

    // 可以使用openssl_get_cipher_methods()查看所有加密模式
    // [16,32 ] 第一位16是iv的长度   第二位32是密钥的长度
    // 长度是对应长度的字符串或者转换的16进制
    private $allowedCiphers = [
        'AES-128-CBC' => [16, 16],
        'AES-192-CBC' => [16, 24],
        'AES-256-CBC' => [16, 32],
        'AES-128-ECB' => [0, 16],
        'AES-256-ECB' => [0, 32],
        'DES-ECB' => [0,8],
        'DES-CBC' => [16,8]
    ];


    public function __construct($secret_key = '',$iv = '',$cipher = '')
    {
        if($cipher) $this->cipher = $cipher;
        if($secret_key) $this->secret_key = $secret_key;
        if($iv) $this->iv = $iv;
    }

    /**
     * 加密
     * @param string | array $data
     * @return false|string
     */
    public function encrypt($data){
        //如果是在php间使用，这里可以使用 serialize() / unserialize()
        // 这里使用json_encode 主要是为了和前端js交互
        if(is_array($data)) $data = json_encode($data);
        $size = $this->allowedCiphers[$this->cipher]??[];
        $ivSize = $size[0]??0;
        $str = openssl_encrypt($data,$this->cipher,$this->secret_key,$this->pad,$ivSize>0?$this->iv:"");
        if($this->base64) return base64_encode($str);
        return $str;
    }

    /**
     * 解密
     * @param string $data
     * @return false|string
     */
    public function decrypt($data){
        if($this->base64) $data = base64_decode($data);
        $size = $this->allowedCiphers[$this->cipher]??[];
        $ivSize = $size[0]??0;
        return openssl_decrypt($data,$this->cipher,$this->secret_key,$this->pad,$ivSize>0?$this->iv:"");
    }
}