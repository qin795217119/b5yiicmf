<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\models\system;
/**
 * This is the model class for table "b5net_role_struct".
 *
 * @property int $role_id 角色ID
 * @property int $menu_id 菜单ID
 */
class RoleStruct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'b5net_role_struct';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['role_id', 'struct_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'role_id' => '角色ID',
            'struct_id' => '组织ID',
        ];
    }
}
