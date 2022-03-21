<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\helpers;

use common\models\Menu;
use Exception;
use yii\helpers\ArrayHelper;
use Yii;

class CommonBack
{
    /**
     * 获取管理员登录信息
     * @param string $key
     * @return bool|mixed
     * @throws Exception
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

    /**
     * 权限判断
     * @param string $controller_name
     * @param string $action_name
     * @return bool
     * @throws Exception
     */
    public static function MenuPowerAuthCheck(string $controller_name='',string $action_name=''):bool
    {
        if(!$controller_name || !$action_name) return true;
        $adminId = Yii::$app->user->getId();
        if ($adminId == 1) return true;
        //检测权限
        $controller_name = strtolower($controller_name);
        $action_name = strtolower($action_name);
        $permission = 'admin:' . $controller_name . ':' . $action_name;

        //不走授权的控制器及、方法及节点
        $notAuthController = ['public', 'common'];
        $notAuthAction = ['tree'];
        $notAuthPermission = ['admin:index:index', 'admin:index:home'];
        if (in_array($controller_name, $notAuthController) || in_array($action_name, $notAuthAction) || in_array($permission, $notAuthPermission) || substr($action_name,0,4) === 'ajax') {
            return true;
        }
        //获取登录时的授权菜单Id
        try {
            $menuList = CommonBack::adminLoginInfo('menu');
        } catch (Exception $e) {
            return false;
        }
        if (empty($menuList)) {
            return false;
        }

        //获取节点信息
        $menuInfo = Menu::findOne(['perms' => $permission]);
        //节点不存在或禁用
        if (!$menuInfo || !$menuInfo['status']) return false;

        if (in_array($menuInfo['id'], $menuList)) return true;
        return false;
    }
}