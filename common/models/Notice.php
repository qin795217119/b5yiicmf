<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\models;

/**
 * This is the model class for table "b5net_notice".
 *
 * @property int $id 公告ID
 * @property string $title 公告标题
 * @property string $type 公告类型（1通知 2公告）
 * @property string $content 公告内容
 * @property string $textarea 非html内容
 * @property string $status 公告状态（1正常 0关闭）
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 */
class Notice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_notice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'type', 'status'], 'trim'],
            [['title', 'type'], 'required'],
            [['title'], 'string', 'max' => 150, 'min' => 2],
            ['status', 'in', 'range' => [0, 1]],
            [['content', 'textarea'], 'string'],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '公告ID',
            'title' => '公告标题',
            'type' => '公告类型（1通知 2公告）',
            'content' => '公告内容',
            'textarea' => '非html内容',
            'status' => '公告状态（1正常 0关闭）',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
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
