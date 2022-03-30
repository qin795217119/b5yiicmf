<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\models\system;

/**
 * This is the model class for table "b5net_admin".
 *
 * @property int $id
 * @property string $username 登录名
 * @property string $password 登录密码
 * @property string $realname 人员姓名
 * @property string $status 状态
 * @property string|null $note 备注
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 * @property string|null $last_time 登录时间
 * @property string|null $last_ip 登录ip
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'realname', 'password', 'status'], 'trim'],
            [['username'], 'required'],
            [['username', 'realname'], 'string', 'max' => 30, 'min' => 2],
            ['username', 'match', 'pattern' => '/^[A-Za-z0-9_-]+$/', 'message' => '{attribute}必须是字母、数字、下划线或破折号'],
            [['password'], 'string', 'max' => 20, 'min' => 6],
            [['note'], 'string', 'max' => 255],
            ['status', 'in', 'range' => [0, 1]],
            [['username'], 'unique'],
            [['create_time', 'update_time', 'last_time', 'last_ip'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '登录名',
            'password' => '登录密码',
            'realname' => '人员姓名',
            'status' => '状态',
            'note' => '备注',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
            'last_time' => '登录时间',
            'last_ip' => '登录ip',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['create_time','update_time'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value'=>function(){
                    return (new \DateTime())->format('Y-m-d H:i:s');
                }
            ]
        ];
    }
}
