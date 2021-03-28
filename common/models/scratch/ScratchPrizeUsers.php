<?php

namespace common\models\scratch;

use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "b5net_scratch_prize_users".
 *
 * @property int $id
 * @property string $openid 微信标识
 * @property string|null $nickname 微信昵称
 * @property string|null $headimg 微信头像
 * @property int $prize_id 奖品ID
 * @property string|null $prize_name 奖品名称
 * @property string $prize_img
 * @property string|null $getcode 兑换码
 * @property int $scratch_id 所属活动
 * @property string $daytime 中奖天
 * @property int $status 兑换状态
 * @property string|null $get_time 兑换时间
 * @property string|null $create_time
 * @property string|null $update_time
 */
class ScratchPrizeUsers extends BaseModel
{
    public $timestamps=false;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_scratch_prize_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nickname','headimg','openid', 'getcode','prize_id','prize_name', 'scratch_id', 'status','get_time', 'create_time', 'update_time','daytime','prize_img'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => '微信标识',
            'nickname' => '微信昵称',
            'headimg' => '微信头像',
            'prize_id' => '奖品ID',
            'prize_name' => '奖品名称',
            'getcode' => '兑换码',
            'scratch_id' => '所属活动',
            'status' => '兑换状态',
            'get_time' => '兑换时间',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
