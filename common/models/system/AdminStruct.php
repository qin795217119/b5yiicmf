<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\models\system;

/**
 * This is the model class for table "b5net_admin_struct".
 *
 * @property int $struct_id 部门id
 * @property int $admin_id 管理员id
 */
class AdminStruct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'b5net_admin_struct';
    }

    public function rules(): array
    {
        return [
            [['admin_id', 'struct_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'admin_id' => '管理员id',
            'struct_id' => '部门id'
        ];
    }
}
