<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\helpers;


class Functions
{
    /**
     * 获取模型错误信息
     * @param $model
     * @param string $default
     * @return string
     */
    public static function getModelError($model,string $default='数据发生错误'):string
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
     * 文件添加域名
     * @param string|null $file
     * @return string
     */
    public static function getFileUrl(string $file = null){
        if(!$file) return '';
        if(strpos($file,'http')!==0){
            $domain = \Yii::$app->params['fileDomain'];
            if(!$domain){
                $domain = \Yii::$app->request->hostInfo;
            }
            $file = str_replace('//','/','/'.$file);
            $file =  $domain.$file;
        }
        return $file;
    }

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
     * 将字符串根据换行、分号、逗号转为数组，并可以再次根据设置分数组
     * @param $value
     * @param string $sediff
     * @return array|false|string[]
     */
    public static function strLineToArray($value, $sediff = '')
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
}