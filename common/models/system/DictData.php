<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\models\system;
/**
 * This is the model class for table "b5net_dict_data".
 *
 * @property int $id 字典编码
 * @property string|null $title 字典标签
 * @property string|null $value 字典键值
 * @property string $type 字典类型
 * @property string $status 状态（1正常 0停用）
 * @property int $list_sort 字典排序
 * @property string|null $remark 备注
 * @property string|null $create_time 创建时间
 * @property string|null $create_by 创建人
 * @property string|null $update_time 更新时间
 * @property string|null $update_by 更新人
 */
class DictData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_dict_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'value', 'type', 'list_sort', 'status', 'css_class', 'list_class'], 'trim'],
            [['title', 'value', 'type', 'list_sort', 'status'], 'required'],
            [['value'], 'string', 'max' => 128],
            [['title', 'type'], 'string', 'max' => 64],
            [['list_sort'], 'integer'],
            ['status', 'in', 'range' => ['0', '1']],
            ['value', 'unique', 'targetAttribute' => ['type', 'value'], 'message' => '{attribute} {value} 在该字典下已经存在'],
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
            'title' => '字典标签',
            'value' => '数据值',
            'type' => '字典类型',
            'list_sort' => '字典排序',
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
                    return (new \DateTime())->format('Y-m-d H:i:s');
                }
            ]
        ];
    }
}
