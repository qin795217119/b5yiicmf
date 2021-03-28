<?php

namespace common\models\scratch;

use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "b5net_scratch".
 *
 * @property int $id
 * @property string $title 活动名称
 * @property int|null $status 活动状态
 * @property int|null $starttime 开始时间
 * @property int|null $endtime 结束时间
 * @property int|null $daynum 每日刮奖次数
 * @property string|null $contents 活动介绍
 * @property string|null $create_time
 * @property string|null $update_time
 * @property string|null $support 技术支持
 * @property string|null $company 主办单位
 */
class Scratch extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_scratch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'start_time', 'end_time'], 'required'],
            [['status', 'daynum'], 'integer'],
            [['contents'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['title', 'support', 'company'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '活动名称',
            'status' => '活动状态',
            'starttime' => '开始时间',
            'endtime' => '结束时间',
            'daynum' => '每日刮奖次数',
            'contents' => '活动介绍',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'support' => '技术支持',
            'company' => '主办单位',
        ];
    }
}
