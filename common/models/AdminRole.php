<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_admin_role".
 *
 * @property int $id
 * @property int $admin_id 用户ID
 * @property int $role_id 角色ID
 */
class AdminRole extends BaseModel
{
    public $timestamps = false;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_admin_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['admin_id', 'role_id'], 'required'],
            [['admin_id', 'role_id'], 'integer'],
            [['admin_id', 'role_id'], 'unique', 'targetAttribute' => ['admin_id', 'role_id']],
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
            'role_id' => '角色ID',
        ];
    }
}
