<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_loginlog".
 *
 * @property int $id 访问ID
 * @property string|null $login_name 登录账号
 * @property string|null $ipaddr 登录IP地址
 * @property string|null $login_location 登录地点
 * @property string|null $browser 浏览器类型
 * @property string|null $os 操作系统
 * @property string|null $net 营运
 * @property string|null $status 登录状态（0成功 1失败）
 * @property string|null $msg 提示消息
 * @property string|null $login_time 访问时间
 */
class Loginlog extends BaseModel
{
    public $timestamps=false;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_loginlog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login_time', 'login_name', 'ipaddr', 'net', 'login_location', 'msg', 'browser', 'os', 'status'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '访问ID',
            'login_name' => '登录账号',
            'ipaddr' => '登录IP地址',
            'login_location' => '登录地点',
            'browser' => '浏览器类型',
            'os' => '操作系统',
            'net' => '营运',
            'status' => '登录状态（0成功 1失败）',
            'msg' => '提示消息',
            'login_time' => '访问时间',
        ];
    }
}
