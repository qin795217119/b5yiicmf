<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_role_menu".
 *
 * @property int $role_id 角色ID
 * @property int $menu_id 菜单ID
 */
class RoleMenu extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_role_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'menu_id'], 'required'],
            [['role_id', 'menu_id'], 'integer'],
            [['role_id', 'menu_id'], 'unique', 'targetAttribute' => ['role_id', 'menu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'role_id' => '角色ID',
            'menu_id' => '菜单ID',
        ];
    }
}
