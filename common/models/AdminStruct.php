<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_admin_struct".
 *
 * @property int $id
 * @property int $admin_id 用户ID
 * @property int $struct_id 组织ID
 */
class AdminStruct extends BaseModel
{
    public $timestamps = false;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_admin_struct';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_id', 'struct_id'], 'required'],
            [['admin_id', 'struct_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'admin_id' => '用户ID',
            'struct_id' => '组织ID',
        ];
    }
}
