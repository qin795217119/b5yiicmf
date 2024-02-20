<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\models\system;

/**
 * This is the model class for table "b5net_area".
 *
 * @property int $id  
 * @property string|null $name
 * @property string $code  
 * @property string $p_code
 * @property int $level  
 * @property string $status
 * @property int $list_sort
 * @property string|null $create_time
 * @property string|null $update_time
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','code','status','list_sort'],'required'],
            ['name','string','max'=>64],
            ['code','string','max'=>32],
            ['code','unique'],
            ['list_sort','integer','min'=>0],
            [['p_code','level','create_time','update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'name' => '名称',
            'code' => '唯一编码',
            'p_code' => '父级',
            'level' => '等级',
            'status' => '状态',
            'list_sort' => '排序'
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
