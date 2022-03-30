<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace backend\extend\helpers;

use common\models\system\Menu;
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
     * 权限判断
     * @param string $module_name
     * @param string $controller_name
     * @param string $action_name
     * @return bool
     */
    public static function checkPower(string $module_name='',string $controller_name='',string $action_name=''):bool
    {
        if(!$controller_name || !$action_name) return false;
        $is_admin  = self::adminLoginInfo('info.is_admin');
        if($is_admin) return true;
        //检测权限
        $controller_name = strtolower($controller_name);
        $action_name = strtolower($action_name);
        $permission = ($module_name?$module_name.':':'') . $controller_name . ':' . $action_name;

        //不走授权的控制器及、方法及节点
        $notAuthController = ['public', 'common'];
        $notAuthAction = ['tree'];
        $notAuthPermission = ['index:index', 'index:home', 'index:download'];
        if (in_array($controller_name, $notAuthController) || in_array($action_name, $notAuthAction) || in_array($permission, $notAuthPermission) || substr($action_name,0,4) === 'ajax') {
            return true;
        }

        //判断登录
        $user_id = self::adminLoginInfo('info.id');
        if (!$user_id == 1) return false;

        //获取登录时的授权菜单Id
        $menuList = self::adminLoginInfo('menu');
        if (empty($menuList)) {
            return false;
        }

        //获取节点信息
        $menuInfo = Menu::findOne(['perms' => $permission]);
        if (!$menuInfo || !$menuInfo['status']) return false;

        //判断是否在权限菜单内
        if (in_array($menuInfo['id'], $menuList)) return true;
        return false;
    }
}