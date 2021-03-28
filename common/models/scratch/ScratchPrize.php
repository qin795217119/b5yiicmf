<?php

namespace common\models\scratch;

use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "b5net_scratch_prize".
 *
 * @property int $id
 * @property int $scratch_id 所属活动
 * @property string $name 奖项名称:一等奖
 * @property string $title 实际名称
 * @property int $allnumber 总数，0为不限制
 * @property int $status 是否显示
 * @property int $isuse 是否可以中将
 * @property int|null $chance 概率
 * @property string|null $thumbimg 奖品图片
 * @property string|null $contents
 */
class ScratchPrize extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_scratch_prize';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['scratch_id','name', 'title', 'allnumber', 'isuse'], 'required'],
            [['allnumber', 'status', 'isuse', 'chance'], 'integer'],
            [['contents'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['title'], 'string', 'max' => 120],
            [['thumbimg'], 'string', 'max' => 255],
            [['get_start','get_end','create_time','update_time'],'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scratch_id' => '所属活动',
            'name' => '奖项名称',
            'title' => '实际名称',
            'allnumber' => '奖品总数',
            'status' => '是否显示',
            'isuse' => '是否可抽取',
            'chance' => '概率',
            'thumbimg' => '奖品图片',
            'contents' => '奖品介绍',
        ];
    }
}
