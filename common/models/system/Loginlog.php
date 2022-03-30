<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\models\system;

use common\helpers\Functions;
use common\helpers\IpLocation\IpLocation;
use common\helpers\UserAgent\Agent;

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
 */
class Loginlog extends \yii\db\ActiveRecord
{
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
            [['login_name', 'ipaddr', 'net', 'login_location', 'msg', 'browser', 'os', 'status'], 'safe']
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
        ];
    }

    //添加日志
    public static function logAdd($login_name, $status, $msg)
    {
        $agent = new Agent();
        $os = $agent->platform() . ' ' . $agent->version($agent->platform());
        $browser = $agent->browser() . ' ' . $agent->version($agent->browser());
        $ip_addr = Functions::getClientIp();
        $login_location = '';
        $net = '';
        if ($ip_addr) {
            $ipLocation = new IpLocation();
            $location = $ipLocation->getlocation($ip_addr);
            if ($location) {
                if ($location['country']) {
                    $login_location = iconv('GBK', 'UTF-8', $location['country']);
                }
                if ($location['area']) {
                    $net = iconv('GBK', 'UTF-8', $location['area']);
                }
            }
        }
        $model = new Loginlog();
        $model->login_name = $login_name;
        $model->ipaddr = $ip_addr;
        $model->browser = $browser;
        $model->os = $os;
        $model->status = $status;
        $model->msg = $msg;
        $model->login_location = $login_location;
        $model->net = $net;
        $model->save(false);
    }

    public static function trash(){
        \Yii::$app->db->createCommand()->truncateTable(static::tableName())->execute();
        return true;
    }
}
