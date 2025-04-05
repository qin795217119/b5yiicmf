<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace backend\extend\helpers;

use yii\helpers\ArrayHelper;
use Yii;

class LoginAuthHelper
{
    /**
     * 获取管理员登录信息
     * @param string $key
     * @return false|mixed
     */
    public static function adminLoginInfo(string $key = '')
    {
        $session = Yii::$app->session->get('adminLoginInfo');
        if (!$key) {
            return $session;
        } else {
            if (empty($session)) return false;
            try {
                return ArrayHelper::getValue($session,$key,false);
            } catch (\Exception $exception){
                return false;
            }
        }
    }

    /**
     * 登录ID
     * @return int
     */
    public static function loginId(): int
    {
        $id = self::adminLoginInfo('info.id');
        return $id > 0 ? intval($id) : 0;
    }

    /**
     * 登录人姓名
     * @return string
     */
    public static function loginName(): string
    {
        $name = self::adminLoginInfo('info.name');
        if(!$name) $name = self::adminLoginInfo('info.username');
        return $name?:'';
    }


    /**
     * 获取登录用户是超管
     * @return bool
     */
    public static function loginAdmin(): bool
    {
        return self::adminLoginInfo('info.is_admin') == 1;
    }

    /**
     * 权限判断
     * @param string $module_name
     * @param string $controller_name
     * @param string $action_name
     * @return bool
     */
    public static function checkPower(string $module_name='',string $controller_name='',string $action_name=''):bool
    {
        //检测权限
        $controller_name = strtolower($controller_name);
        $action_name = strtolower($action_name);
        $permission = ($module_name?$module_name.':':'') . $controller_name . ':' . $action_name;
        return Permission::hasPerm($permission);
    }

}