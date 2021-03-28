<?php

namespace common\models\scratch;

use Yii;

/**
 * This is the model class for table "b5net_scratch_users_logs".
 *
 * @property int $id  
 * @property string|null $openid
 * @property string|null $create_time
 * @property int|null $scratch_id
 * @property string|null $daytime
 */
class ScratchUsersLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_scratch_users_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['create_time', 'daytime','openid','scratch_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => ' ',
            'openid' => 'Openid',
            'create_time' => 'Create Time',
            'scratch_id' => 'Scratch ID',
            'daytime' => 'Daytime',
        ];
    }
}
