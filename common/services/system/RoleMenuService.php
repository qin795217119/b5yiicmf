<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;

class RoleMenuService
{
    protected $table = 'b5net_role_menu';

    /**
     * 更新授权信息
     * @param $role_id
     * @param null $treeId
     * @return bool
     */
    public function update($role_id, $treeId = null): bool
    {
        if (empty($role_id)) {
            return false;
        }

        if (!$this->deleteByRole($role_id)) {
            return false;
        }

        if (!$treeId) return true;
        if (!is_array($treeId)) {
            $treeId = explode(',', $treeId);
        }
        $treeId = array_unique($treeId);
        $data = [];
        $filed = ['role_id', 'menu_id'];
        foreach ($treeId as $menu_id) {
            if ($menu_id) {
                $data[] = [$role_id, $menu_id];
            }
        }
        if (!$data) return true;
        try {
            \Yii::$app->db->createCommand()->batchInsert($this->table, $filed, $data)->execute();
            return true;
        } catch (\yii\db\Exception $exception) {
            return false;
        }
    }

    /**
     * 获取角色分组的菜单权限ID
     * @param $role_id
     * @return array
     */
    public function getRoleMenuList($role_id): array
    {
        if (!$role_id) return [];
        $list = (new \yii\db\Query())->from($this->table)->where(['role_id' => $role_id])->all();
        return $list ? array_unique(array_column($list, 'menu_id')) : [];
    }

    /**
     * 删除某个角色的授权信息
     * @param $role_id
     * @return bool
     */
    public function deleteByRole($role_id): bool
    {
        if ($role_id) {
            try {
                \Yii::$app->db->createCommand()->delete($this->table, 'role_id = ' . $role_id)->execute();
                return true;
            } catch (\yii\db\Exception $exception) {
                return false;
            }
        }
        return false;
    }

    /**
     * 删除某个菜单的授权信息
     * @param $menu_id
     * @return bool
     */
    public function deleteByMenu($menu_id): bool
    {
        if ($menu_id) {
            try {
                \Yii::$app->db->createCommand()->delete($this->table, 'menu_id = ' . $menu_id)->execute();
                return true;
            } catch (\yii\db\Exception $exception) {
                return false;
            }
        }
        return false;
    }
}