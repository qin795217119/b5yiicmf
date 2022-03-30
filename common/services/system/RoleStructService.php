<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;

class RoleStructService
{
    protected $table = 'b5net_role_struct';
    /**
     * 更新授权信息
     * @param $role_id
     * @param string|array $struct_id
     * @return bool
     */
    public function update($role_id, $struct_id = null): bool
    {
        if (!$role_id) {
            return false;
        }

        if(!$this->deleteByRole($role_id)){
            return false;
        }

        if (!$struct_id) return true;

        if (!is_array($struct_id)) {
            $struct_id = explode(',', $struct_id);
        }
        $struct_id = array_unique($struct_id);
        $data = [];
        $filed = ['role_id','struct_id'];
        foreach ($struct_id as $id) {
            if ($id) {
                $data[] = [$role_id, $id];
            }
        }
        if(!$data) return true;
        try {
            \Yii::$app->db->createCommand()->batchInsert($this->table,$filed,$data)->execute();
            return true;
        } catch (\yii\db\Exception $exception){
            return false;
        }
    }

    /**
     * 获取角色分组的组织权限ID
     * @param $role_id
     * @return array
     */
    public function getRoleStructList($role_id): array
    {
        if (!$role_id) return [];
        $list = (new \yii\db\Query())->from($this->table)->where(['role_id' => $role_id])->all();
        return $list ? array_unique(array_column($list, 'struct_id')) : [];
    }

    /**
     * 删除某个角色的数据权限信息
     * @param $role_id
     * @return bool
     */
    public function deleteByRole($role_id):bool{
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
     * 删除某个组织的数据权限信息
     * @param $struct_id
     * @return bool
     */
    public function deleteByStruct($struct_id):bool{
        if ($struct_id) {
            try {
                \Yii::$app->db->createCommand()->delete($this->table, 'struct_id = ' . $struct_id)->execute();
                return true;
            } catch (\yii\db\Exception $exception) {
                return false;
            }
        }
        return false;
    }
}
