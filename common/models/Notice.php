<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_notice".
 *
 * @property int $id 公告ID
 * @property string $title 公告标题
 * @property string|null $type 公告类型（1通知 2公告）
 * @property string|null $content 公告内容
 * @property string|null $textarea 非html内容
 * @property string $status 公告状态（1正常 0关闭）
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 */
class Notice extends BaseModel
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
}
