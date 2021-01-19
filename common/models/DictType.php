<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_dict_type".
 *
 * @property int $id 字典主键
 * @property string $name 字典名称
 * @property string $type 字典类型
 * @property string $status 状态（1正常 0停用）
 * @property int $listsort
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 * @property string|null $note 备注
 */
class DictType extends BaseModel
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
            [['name', 'type', 'listsort', 'status'], 'trim'],
            [['name', 'type'], 'required'],
            [['name', 'type'], 'string', 'max' => 50],
            ['type', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => '{attribute}必须是字母、数字、下划线或破折号'],
            [['type'], 'unique'],
            [['listsort'], 'integer'],
            ['status', 'in', 'range' => [0, 1]],
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
            'name' => '字典名称',
            'type' => '字典类型',
            'status' => '状态',
            'listsort' => '排序',
            'note' => '备注',
        ];
    }
}
