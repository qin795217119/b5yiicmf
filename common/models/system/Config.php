<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\models\system;

/**
 * This is the model class for table "b5net_config".
 *
 * @property int $id 配置ID
 * @property string $title 配置名称
 * @property string $type 配置标识
 * @property string $style 配置类型
 * @property string $is_sys 是否系统内置 0否 1是
 * @property string|null $groups 配置分组
 * @property string|null $value 配置值
 * @property string|null $extra 配置项
 * @property string|null $note 配置说明
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'type', 'style', 'groups'], 'trim'],
            [['title','type','style'],'required'],
            [['title'], 'string', 'max' => 50, 'min' => 2],
            [['type'], 'string', 'max' => 30, 'min' => 2],
            ['type','match', 'pattern' => '/^[A-Za-z0-9_-]+$/','message'=>'{attribute}必须是字母、数字、下划线或破折号'],
            ['type','unique'],
            [['extra', 'note'], 'string', 'max' => 255],
            [['create_time', 'update_time','value','is_sys','groups'], 'safe'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
			'id' => 'ID',
            'title' => '配置名称',
            'type' => '配置标识',
            'style' => '配置类型',
            'extra' => '配置项',
            'note' => '配置说明',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['create_time','update_time'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value'=>function(){
                    return (new \DateTime())->format('Y-m-d H:i:s');
                }
            ]
        ];
    }
}
