<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;

use common\cache\PositionCache;

class AdminPosService
{
    protected $table = 'b5net_admin_pos';

    /**
     * 更新信息
     * @param $admin_id
     * @param $pos_ids
     * @return bool
     */
    public function update($admin_id, $pos_ids): bool
    {
        if (!$admin_id) return false;
        try {
            \Yii::$app->db->createCommand()->delete($this->table, 'admin_id = ' . $admin_id)->execute();
        } catch (\yii\db\Exception $exception) {
            return false;
        }
        if (!$pos_ids) return true;

        if (!is_array($pos_ids)) {
            $pos_ids = explode(',', $pos_ids);
        }
        $pos_ids = array_unique($pos_ids);
        $data = [];
        $filed = ['admin_id', 'pos_id'];
        foreach ($pos_ids as $pos_id) {
            if ($pos_id) {
                $data[] = [$admin_id, $pos_id];
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
     * 获取某个人员的岗位
     * @param $admin_id
     * @param false $showPos
     * @return array|false|mixed
     */
    public function getPosByAdmin($admin_id, $showPos = false)
    {
        if (!$admin_id) return [];

        $info = (new \yii\db\Query())->from($this->table)->where(['admin_id' => $admin_id])->one();
        if (!$info) return [];

        if (!$showPos) return $info['pos_id'];

        $posList = PositionCache::lists();
        $posList = array_column($posList,null,'id');

        return $posList[$info['pos_id']] ?? [];
    }



    /**
     * 删除某个角色的岗位
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
     * 删除某个岗位的人员信息
     * @param $pos_id
     * @return bool
     */
    public function deleteByPos($pos_id): bool
    {
        if ($pos_id) {
            try {
                \Yii::$app->db->createCommand()->delete($this->table, 'pos_id = ' . $pos_id)->execute();
                return true;
            } catch (\yii\db\Exception $exception) {
                return false;
            }
        }
        return false;
    }
}
