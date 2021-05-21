<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_smscode".
 *
 * @property int $id
 * @property string $mobile 手机号码
 * @property string $code 验证码
 * @property int $type 例如：1注册 2登录 3忘记密码
 * @property int $status 状态 0未验证 1已验证
 * @property string $os 运营商
 * @property string|null $create_time
 * @property string|null $update_time
 */
class Smscode extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_smscode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['mobile', 'code', 'os'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mobile' => '手机号码',
            'code' => '验证码',
            'type' => '例如：1注册 2登录 3忘记密码',
            'status' => '状态 0未验证 1已验证',
            'os' => '运营商',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
