<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use yii\base\Model;
use yii\behaviors\TimestampBehavior;
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


    public function behaviors()
    {
        if($this->timestamps){
            return [
                'timestamp' => [
                    'class' => TimestampBehavior::className(),
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_INSERT => ['create_time','update_time'],
                        ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                    ],
                    'value'=>function(){
                        return (new \DateTime())->format('Y-m-d H:i:s');
                    }
                ]
            ];
        }
        return [];
    }

}
