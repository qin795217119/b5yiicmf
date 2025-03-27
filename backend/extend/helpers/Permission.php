<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace backend\extend\helpers;

use common\models\system\Menu;
use Yii;

class Permission
{

    /**
     * 判断用户是否是超管
     * @param $userId
     * @return bool
     */
    public static function isAdmin($userId): bool
    {
        return $userId == Yii::$app->params['root_admin_id'];
    }

    /**
     * 检测权限，可用于前端
     * @param $permission
     * @return bool
     */
    public static function hasPerm($permission): bool
    {
        $permission = strtolower($permission);
        $permissionArr = explode(':', $permission);
        if (count($permissionArr) < 2) {
            return false;
        } elseif (count($permissionArr) == 2) {
            $controller_name = $permissionArr[0];
            $action_name = $permissionArr[1];
        } else {
            $controller_name = $permissionArr[1];
            $action_name = $permissionArr[2];
        }

        //不走授权的控制器及、方法及节点
        $notAuthController = ['public', 'common'];
        $notAuthAction = ['tree'];
        $notAuthPermission = ['index:index', 'index:home', 'index:download'];
        if (in_array($controller_name, $notAuthController) || in_array($action_name, $notAuthAction) || in_array($permission, $notAuthPermission) || substr($action_name,0,4) === 'ajax') {
            return true;
        }

        //判断登录
        $user_id = LoginAuthHelper::loginId();
        if ($user_id < 1) return false;

        // 是否超管
        $is_admin  = LoginAuthHelper::loginAdmin();
        if($is_admin) return true;

        //获取登录时的授权菜单Id
        $menuList = LoginAuthHelper::adminLoginInfo('menu');
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