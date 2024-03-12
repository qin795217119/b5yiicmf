<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\models\system;

/**
 * This is the model class for table "b5net_dict_type".
 *
 * @property int $id 字典主键
 * @property string $name 字典名称
 * @property string $type 字典类型
 * @property string $status 状态（1正常 0停用）
 * @property string|null $remark
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 */
class DictType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_dict_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'status'], 'trim'],
            [['name', 'type', 'status'], 'required'],
            [['name', 'type'], 'string', 'max' => 64],
            ['type', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => '{attribute}必须是字母、数字、下划线或破折号'],
            [['type'], 'unique'],
            ['status', 'in', 'range' => ['0', '1']],
            [['remark'], 'string', 'max' => 255],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => '字典名称',
            'type' => '字典类型',
            'status' => '状态',
            'remark' => '备注',
        ];
    }
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value' => function () {
                    return date('Y-m-d H:i:s',time());
                }
            ]
        ];
    }
}
