<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * 人员管理-模型
 * Class BaseModel
 * @package App\Models
 */
class BaseModel extends ActiveRecord
{
    //是否自动维护时间戳
    public $timestamps = true;

    /**
     * 更新数据
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->timestamps) {
            if ($this->isNewRecord) {
                $this->create_time = date('Y-m-d H:i:s', time());
            }
            $this->update_time = date('Y-m-d H:i:s', time());
        }
        return parent::save($runValidation, $attributeNames);
    }

    /**
     * 批量插入
     * @param $field
     * @param $data
     * @return bool|int
     * @throws \yii\db\Exception
     */
    public function insertAll($field, $data)
    {
        if (!$data || !$field) return false;
        return Yii::$app->db->createCommand()->batchInsert($this::tableName(), $field, $data)->execute();
    }

    /**
     * 清空表
     */
    public function trash()
    {
        Yii::$app->db->createCommand()->truncateTable($this::tableName())->execute();
        return true;
    }

}
