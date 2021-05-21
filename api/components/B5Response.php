<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace api\components;

use yii\web\Response;

class B5Response extends Response
{
    private $callback = '';
    private $isReturn = true;

    /**
     * B5response constructor.
     * @param string $callback
     * @param bool $isReturn
     * @param array $config
     */
    public function __construct(string $callback, bool $isReturn, array $config = [])
    {
        parent::__construct($config);
        $this->callback = $callback;
        $this->isReturn = $isReturn;
    }

    public function returnJson($message, $code, $data = [], $url = '')
    {
        if ($this->callback) {
            $this->format = self::FORMAT_JSONP;
            $this->data = [
                'callback' => $this->callback,
                'data' => [
                    'msg' => $message,
                    'code' => $code,
                    'data' => $data?:(object)[],
                    'url' => $url
                ]
            ];
        } else {
            $this->format = self::FORMAT_JSON;
            $this->data = [
                'msg' => $message,
                'code' => $code,
                'data' => $data?:(object)[],
                'url' => $url
            ];
        }
        if ($this->isReturn) {
            return $this;
        } else {
            \Yii::$app->response->format = $this->format;
            \Yii::$app->response->data = $this->data;
            return false;
        }
    }

    public function b5success($message = '操作成功',$data = [], $code = 0, $url = '')
    {
        return $this->returnJson($message, $code, $data, $url);
    }

    public function b5error($message = '操作失败', $data = [], $code = -1, $url = '' )
    {
        return $this->returnJson($message, $code, $data, $url);
    }

}