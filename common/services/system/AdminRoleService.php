<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;

use common\models\system\AdminRole;
use common\models\system\Role;

class AdminRoleService
{
    /**
     * 更新信息
     * @param $admin_id
     * @param null $role_ids
     * @return bool
     */
    public static function update($admin_id, $role_ids = null): bool
    {
        if (!$admin_id) return false;
        try {
            \Yii::$app->db->createCommand()->delete(AdminRole::tableName(), 'admin_id = ' . $admin_id)->execute();
        } catch (\yii\db\Exception $exception) {
            return false;
        }

        if (!$role_ids) return true;

        if (!is_array($role_ids)) {
            $role_ids = explode(',', $role_ids);
        }
        $role_ids = array_unique($role_ids);
        $data = [];
        $filed = ['admin_id', 'role_id'];
        foreach ($role_ids as $role_id) {
            if ($role_id) {
                $data[] = [$admin_id, $role_id];
            }
        }
        if (!$data) return true;
        try {
            \Yii::$app->db->createCommand()->batchInsert(AdminRole::tableName(), $filed, $data)->execute();
            return true;
        } catch (\yii\db\Exception $exception) {
            return false;
        }
    }

    /**
     * 获取某个人员的角色列表
     * @param $admin_id
     * @param false $showRole 是否显示角色详细信息
     * @return array
     */
    public static function getRoleByAdmin($admin_id, $showRole = false): array
    {
        if (!$admin_id) return [];

        $list = (new \yii\db\Query())->from(AdminRole::tableName())->where(['admin_id' => $admin_id])->all();

        if (!$showRole) {
            return $list ? array_column($list, 'role_id') : [];
        }
        $result = [];
        foreach ($list as $value) {
            $info = Role::findOne($value['role_id']);
            if ($info) {
                $result[] = $info->toArray();
            }
        }
        return $result;
    }

    /**
     * 获取某个角色下的所有用户ID
     * @param $role_id
     * @return array
     */
    public static function getAdminIdByRoleId($role_id): array
    {
        if (!$role_id) return [];
        $list = (new \yii\db\Query())->from(AdminRole::tableName())->where(['role_id' => $role_id])->all();
        return $list ? array_column($list, 'admin_id') : [];
    }

    /**
     * 删除某个角色的管理员信息
     * @param $role_id
     * @return bool
     */
    public static function deleteByRole($role_id): bool
    {
        if ($role_id) {
            try {
                \Yii::$app->db->createCommand()->delete(AdminRole::tableName(), 'role_id = ' . $role_id)->execute();
                return true;
            } catch (\yii\db\Exception $exception) {
                return false;
            }
        }
        return false;
    }

    /**
     * 删除某个管理员的角色信息
     * @param $admin_id
     * @return bool
     */
    public static function deleteByAdmin($admin_id): bool
    {
        if ($admin_id) {
            try {
                \Yii::$app->db->createCommand()->delete(AdminRole::tableName(), 'admin_id = ' . $admin_id)->execute();
                return true;
            } catch (\yii\db\Exception $exception) {
                return false;
            }
        }
        return false;
    }
}
