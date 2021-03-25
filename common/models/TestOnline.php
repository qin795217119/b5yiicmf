<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_test_online".
 *
 * @property string $ip
 * @property string $create_time 添加时间
 * @property string $update_time 添加时间
 * @property string $fd
 * @property int $isrun
 */
class TestOnline extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_test_online';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip','fd'], 'required'],
            [['create_time','isrun','update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ip' => '用户Ip',
            'create_time' => '添加时间',
            'fd'=>'',
            'isrun'=>'',
            'update_time'=>''
        ];
    }
}
