<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_wechat_access".
 *
 * @property string $appid
 * @property string $access_token
 * @property string $jsapi_ticket
 * @property int $access_token_add
 * @property int $jsapi_ticket_add
 */
class WechatAccess extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_wechat_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['access_token', 'jsapi_ticket', 'access_token_add', 'jsapi_ticket_add', 'appid'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'appid' => 'Appid',
            'access_token' => 'Access Token',
            'jsapi_ticket' => 'Jsapi Ticket',
            'access_token_add' => 'Access Token Add',
            'jsapi_ticket_add' => 'Jsapi Ticket Add',
        ];
    }
}
