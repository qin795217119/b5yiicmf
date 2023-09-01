<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\models\system;

/**
 * This is the model class for table "b5net_admin_pos".
 *
 * @property int $pos_id 岗位id
 * @property int $admin_id 管理员id
 */
class AdminPos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'b5net_admin_pos';
    }

    public function rules(): array
    {
        return [
            [['admin_id', 'pos_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'admin_id' => '管理员id',
            'pos_id' => '岗位id'
        ];
    }
}
