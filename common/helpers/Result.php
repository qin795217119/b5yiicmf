<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\helpers;

use yii\web\Response;

class Result
{
    /**
     * 成功的数组
     * @param string $msg
     * @param array|string $data
     * @param array $extend
     * @return array
     */
    public static function rsuccess(string $msg = '', $data = [], array $extend = []): array
    {
        return static::message($msg, true, $data, 0, $extend,false);
    }

    /**
     * 失败数组
     * @param string $msg
     * @param int $code
     * @return array
     */
    public static function rerror(string $msg = '', int $code = 500): array
    {
        return static::message($msg, false, [], $code,[],false);
    }

    /**
     * 成功的JSON
     * @param string $msg
     * @param array|string $data
     * @param array $extend
     * @param int $code
     * @return array
     */
    public static function success(string $msg = '', $data = [], array $extend = [],int $code = 0): array
    {
        return static::message($msg, true, $data, $code, $extend);
    }

    /**
     * 失败JSON
     * @param string $msg
     * @param int $code
     * @return array
     */
    public static function error(string $msg = '', int $code = 500): array
    {
        return static::message($msg, false, [], $code);
    }

    /**
     * 返回json数据，统一格式
     * @param string $msg
     * @param bool $success
     * @param array|string $data
     * @param int $code
     * @param array $extend
     * @param bool $isJson
     * @return array
     */
    public static function message(string $msg, bool $success, $data = [], int $code = -1, array $extend = [],$isJson = true): array
    {
        $result = [
            'code' => $code < 0 ? ($success ? 0 : 500) : $code,
            'msg' => $msg ?: ($success ? '操作成功' : '操作失败'),
            'data' => $data,
            'success' => $success
        ];
        if ($extend) {
            foreach ($extend as $key => $value) {
                $result[$key] = $value;
            }
        }
        if($isJson) \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }
}