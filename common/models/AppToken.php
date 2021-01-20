<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_app_token".
 *
 * @property string $token
 * @property int $user_id 用户ID
 * @property int $addtime 添加时间
 * @property string $type 类型
 */
class AppToken extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_app_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token'], 'required'],
            [['user_id', 'addtime'], 'integer'],
            [['token'], 'string', 'max' => 250],
            [['type'], 'string', 'max' => 30],
            [['token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'token' => 'Token',
            'user_id' => '用户ID',
            'addtime' => '添加时间',
            'type' => '类型',
        ];
    }
}
