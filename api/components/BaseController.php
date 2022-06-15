<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace api\components;

use common\helpers\Result;
use yii\base\Controller;

class BaseController extends Controller
{
    /**
     * 应用实例
     * @var \yii\web\Application
     */
    protected $app;


    /**
     * 构造函数
     * BaseController constructor.
     */
    public function init()
    {
        parent::init();
        $this->app = \Yii::$app;
    }


    /**
     * 错误提示
     * @param string $msg
     * @param int $code
     * @return array
     */
    public function error(string $msg='',int $code = 1){
        return Result::error($msg,$code);
    }

    /**
     * 跳转成功
     * @param string $msg
     * @param array $data
     * @param array $extend
     * @param int $code
     * @return array
     */
    public function success(string $msg = '', array $data = [], array $extend = [],int $code=0){
        return Result::success($msg,$data,$extend,$code);
    }
}
