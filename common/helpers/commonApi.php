<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\helpers;

use Yii;
use yii\helpers\ArrayHelper;

class commonApi
{
    /**获取客户端ip
     * @return string
     */
    public static function getClientIp ()
    {
        if (getenv('HTTP_CLIENT_IP')) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('REMOTE_ADDR')) {
            $ip = getenv('REMOTE_ADDR');
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    /**
     * 获取模型错误信息
     * @param $model
     * @param string $default
     * @return mixed|string
     */
    public static function getModelError($model,$default='数据发生错误')
    {
        $error = '';
        if ($model && $model->firstErrors) {
            foreach ($model->firstErrors as $val) {
                $error = $val;
                break;
            }
        }
        return empty($error) ? $default : $error;
    }

    /**
     * 获取管理员登录信息
     * @param null $key
     * @return bool|mixed
     * @throws \Exception
     */
    public static function adminLoginInfo($key = null)
    {
        $session = Yii::$app->session->get(Yii::$app->params['adminLoginSession']);
        if (is_null($key)) {
            return $session;
        } else {
            if (empty($session)) return false;
            return ArrayHelper::getValue($session,$key,false);
        }
    }

    /**
     * 获取系统是否开启演示模式
     * @return bool|mixed|null
     * @throws \Exception
     */
    public static function system_isDemo()
    {
        if(defined('MODULE_NAME') && MODULE_NAME==='admin'){
            $status = \common\cache\ConfigCache::get('sys_config_demo');
            $status == '1' ? true : false;
            $loginId = self::adminLoginInfo('info.id');
            $isAdmin = $loginId == '1' ? true : false;
            if ($isAdmin) {
                return false;
            }
            return $status;
        }
        return  false;
    }

    /**
     * 获取双MD5加密
     * @param string $str 加密字符串
     * @return string 输出MD5加密字符串
     */
    public static function get_enstr($str)
    {
        return md5(md5($str) . 'b5net');
    }

    /**
     * 消息数组
     * @param string $msg
     * @param bool $success
     * @param array $data
     * @param int $code
     * @param string $url
     * @param array $extend
     * @return array
     */
    public static function message($msg = "操作成功", $success = true, $data = [], $code = null, $url = '', $extend = [])
    {
        $result = ['success' => $success, 'msg' => $msg, 'data' => $data, 'url' => $url];
        if ($success) {
            $result['code'] = is_null($code) ? 0 : $code;
        } else {
            $result['code'] = is_null($code) ? -1 : $code;
        }
        if ($extend) {
            foreach ($extend as $key => $value) {
                $result[$key] = $value;
            }
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $result;
    }

    /**
     * 获取图片地址
     * @param string $image_url 图片地址
     * @return string 返回图片网络地址
     */
    public static function get_image_url($image_url, $default = '')
    {
        if (!$image_url) return $default;
        if (strpos($image_url, ',')) {
            $image_url = explode(',', $image_url);
        }
        if (is_array($image_url)) {
            $reInfo = [];
            foreach ($image_url as $img) {
                if ($img) {
                    $reInfo[] = self::get_image_url($img);
                }
            }
            return $reInfo;
        }
        if (strpos($image_url, 'http') === 0) {
            return $image_url;
        } else {
            return IMG_URL . $image_url;
        }
    }

    /**
     * 字符串截取
     * @param string $str 需要截取的字符串
     * @param int $start 开始位置
     * @param int $length 截取长度
     * @param bool $suffix 截断显示字符
     * @param string $charset 编码格式
     * @return string 返回结果
     */
    public static function sub_str($str, $start = 0, $length = 10, $suffix = true, $charset = "utf-8")
    {
        if (function_exists("mb_substr")) {
            $slice = mb_substr($str, $start, $length, $charset);
        } elseif (function_exists('iconv_substr')) {
            $slice = iconv_substr($str, $start, $length, $charset);
        } else {
            $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
            $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
            $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
            $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("", array_slice($match[0], $start, $length));
        }
        $omit = mb_strlen($str) >= $length ? '...' : '';
        return $suffix ? $slice . $omit : $slice;
    }

    /**
     * 将字符串根据换行、分号、逗号转为数组，并可以再次根据设置分数组
     * @param $value
     * @param string $sediff
     * @return array|false|string[]
     */
    public static function strline_array($value, $sediff = '')
    {
        if ($value) {
            $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
            if ($sediff && strpos($value, $sediff)) {
                $value = [];
                foreach ($array as $val) {
                    list($k, $v) = explode($sediff, $val);
                    $value[$k] = $v;
                }
            } else {
                $value = $array;
            }
        } else {
            $value = [];
        }
        return $value;
    }

    /**
     * 判断变量是否为null或空字符串
     * @param $key
     * @return bool
     */
    public static function paramSet($key)
    {
        if (is_null($key) || $key === '') {
            return false;
        }
        return true;
    }

    /**
     * 将二维数组 变成一维 以某个值为键或以某个值为值
     * @param array $arr
     * @param string $key
     * @param string|null $valueKey
     * @return array
     */
    public static function arr_keymap(array $arr, string $key, string $valueKey = null)
    {
        if (empty($arr)) return [];
        if (empty($key)) return $arr;
        $reArr = [];
        foreach ($arr as $value) {
            if (is_array($value) && isset($value[$key])) {
                if (self::paramSet($valueKey)) {
                    $reArr[$value[$key]] = $value[$valueKey] ?? '';
                } else {
                    $reArr[$value[$key]] = $value;
                }
            }
        }
        return $reArr;
    }

    /**
     * 跳转
     * @param $url
     * @return bool
     */
    public static function b5redirect($url){
        if(!$url) return false;
        header("Location:{$url}");
    }

    /**
     * 拼接域名
     * @param $url
     * @param string $deurl
     * @return string
     */
    public static function getDomain($url,$deurl=''){
        $url=trim($url);
        if(!$url){
            if(!$deurl) return '';
            $url=$deurl;
        }
        if(strpos($url,'http')===0 || strpos($url,'//')===0 || filter_var($url,FILTER_VALIDATE_URL)!==false){
            return $url;
        }
        return \Yii::$app->request->hostInfo.$url;
    }

    /**
     * curl的POST请求
     * @param $url
     * @param $array
     * @return bool|string
     */
    public static function b5curl_post($url, $array)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        $post_data = $array;
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }

    /**curl的GET请求
     * @param $url
     * @return bool|string
     */
    public static function b5curl_get($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }
}
