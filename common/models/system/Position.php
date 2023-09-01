<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\models\system;

/**
 * This is the model class for table "b5net_position".
 *
 * @property int $id
 * @property string $name  岗位名称
 * @property string $pos_key  岗位标识
 * @property int $list_sort  排序
 * @property string $status  状态
 * @property string $note  备注
 * @property string|null $create_time
 * @property string|null $update_time
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_position';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'pos_key', 'list_sort'], 'trim'],
            [['name', 'pos_key', 'list_sort'], 'required'],
            [['name'], 'string', 'max' => 50, 'min' => 2],
            [['pos_key'], 'string', 'max' => 50, 'min' => 2],
            ['pos_key', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => '{attribute}必须是字母、数字、下划线或破折号'],

            [['note'], 'string', 'max' => 255],
            [['create_time', 'update_time', 'status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'name' => '岗位名称',
            'pos_key' => '岗位标识',
            'list_sort' => '排序',
            'status' => '状态',
            'note' => '备注',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
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
