<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_role_struct".
 *
 * @property int $role_id 角色ID
 * @property int $struct_id 部门ID
 */
class RoleStruct extends BaseModel
{
    public $timestamps = false;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_role_struct';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'struct_id'], 'required'],
            [['role_id', 'struct_id'], 'integer'],
            [['role_id', 'struct_id'], 'unique', 'targetAttribute' => ['role_id', 'struct_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'role_id' => '角色ID',
            'menu_id' => '部门ID',
        ];
    }
}
