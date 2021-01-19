<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_wechat_users".
 *
 * @property int $id
 * @property string $openid 唯一标识
 * @property string $appid 公众号参数
 * @property string $nickname 昵称
 * @property string $headimg 头像地址
 * @property string|null $update_time 资料更新时间
 * @property string|null $create_time 添加时间
 * @property int $sex 性别
 * @property string $city 城市
 * @property string $country 国家
 * @property string $province 省份
 * @property int $status 状态
 */
class WechatUsers extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_wechat_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['openid'], 'unique', 'targetAttribute' => ['openid', 'appid']],
            [['appid', 'nickname', 'city', 'country', 'province', 'headimg', 'sex', 'status', 'update_time', 'create_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'openid' => '唯一标识',
            'appid' => '公众号参数',
            'nickname' => '昵称',
            'headimg' => '头像地址',
            'update_time' => '资料更新时间',
            'create_time' => '添加时间',
            'sex' => '性别',
            'city' => '城市',
            'country' => '国家',
            'province' => '省份',
            'status' => '状态',
        ];
    }
}
