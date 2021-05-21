<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\helpers;

use yii\helpers\ArrayHelper;
use Yii;

class CommonBack
{
    /**
     * 获取管理员登录信息
     * @param string $key
     * @return bool|mixed
     * @throws \Exception
     */
    public static function adminLoginInfo(string $key = null)
    {
        $session = Yii::$app->session->get(Yii::$app->params['adminLoginSession']);
        if (is_null($key)) {
            return $session;
        } else {
            if (empty($session)) return false;
            return ArrayHelper::getValue($session,$key,false);
        }
    }
}