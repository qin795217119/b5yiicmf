<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_dict_data".
 *
 * @property int $id 字典编码
 * @property string $name 字典标签
 * @property string $value 字典键值
 * @property string $type 字典类型
 * @property int $listsort 字典排序
 * @property string $status 状态（1正常 0停用）
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 * @property string|null $note 备注
 */
class DictData extends BaseModel
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
            [['name', 'value', 'type', 'listsort', 'status'], 'trim'],
            [['name', 'value', 'type', 'listsort'], 'required'],
            [['name', 'value', 'type'], 'string', 'max' => 100],
            [['listsort'], 'integer'],
            ['status', 'in', 'range' => [0, 1]],
            ['value', 'unique', 'targetAttribute' => ['type', 'value'], 'message' => '{attribute} {value} 在该字典下已经存在'],
            [['note'], 'string', 'max' => 500],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => '字典标签',
            'value' => '数据值',
            'type' => '字典类型',
            'listsort' => '字典排序',
            'status' => '状态',
            'note' => '备注',
        ];
    }
}
