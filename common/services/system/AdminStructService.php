<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;

use common\models\system\Struct;

class AdminStructService
{
    protected $table = 'b5net_admin_struct';

    /**
     * 更新信息
     * @param $admin_id
     * @param $struct_ids
     * @return bool
     */
    public function update($admin_id, $struct_ids): bool
    {
        if (!$admin_id) return false;
        try {
            \Yii::$app->db->createCommand()->delete($this->table, 'admin_id = ' . $admin_id)->execute();
        } catch (\yii\db\Exception $exception) {
            return false;
        }
        if (!$struct_ids) return true;

        if (!is_array($struct_ids)) {
            $struct_ids = explode(',', $struct_ids);
        }
        $struct_ids = array_unique($struct_ids);
        $data = [];
        $filed = ['admin_id', 'struct_id'];
        foreach ($struct_ids as $struct_id) {
            if ($struct_id) {
                $data[] = [$admin_id, $struct_id];
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
     * 获取某个人员的组织部门
     * @param $admin_id
     * @param false $showStruct
     * @return array|false|mixed
     */
    public function getStructByAdminId($admin_id, $showStruct = false)
    {
        if (!$admin_id) return [];

        $list = (new \yii\db\Query())->from($this->table)->where(['admin_id' => $admin_id])->all();
        if (!$list) return [];

        $list = array_unique(array_column($list,'struct_id'));

        $list = Struct::find()->where(['id'=>$list,'status'=>1])->select(['id','name'])->orderBy('parent_id asc,listsort asc,id asc')->asArray()->all();
        if(!$showStruct){
           return $list?array_column($list,'id'):[];
        }
        return $list?:[];
    }

    /**
     * 获取某个组织下的用户
     * @param $struct_id
     * @return array
     */
    public function getAdminIdByStructId($struct_id): array
    {
        if (!$struct_id) return [];
        $list = (new \yii\db\Query())->from($this->table)->where(['struct_id' => $struct_id])->all();
        return $list ? array_unique(array_column($list, 'admin_id')) : [];
    }

    /**
     * 删除某个角色的组织信息
     * @param $admin_id
     * @return bool
     */
    public function deleteByAdmin($admin_id): bool
    {
        if ($admin_id) {
            try {
                \Yii::$app->db->createCommand()->delete($this->table, 'admin_id = ' . $admin_id)->execute();
                return true;
            } catch (\yii\db\Exception $exception) {
                return false;
            }
        }
        return false;
    }

    /**
     * 删除某个组织的角色信息
     * @param $struct_id
     * @return bool
     */
    public function deleteByStruct($struct_id): bool
    {
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
