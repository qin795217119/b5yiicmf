<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\models\system;
/**
 * This is the model class for table "b5net_role".
 *
 * @property int $id 角色ID
 * @property string $name 角色名称
 * @property string $rolekey 角色权限字符串
 * @property int $listsort 显示顺序
 * @property int $data_scope 数据范围
 * @property string $status 角色状态（1正常 0停用）
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 * @property string|null $note 备注
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'rolekey', 'listsort', 'status'], 'trim'],
            [['name', 'rolekey'], 'required'],
            [['name', 'rolekey'], 'string', 'max' => 30],
            ['rolekey','match', 'pattern' => '/^[A-Za-z0-9_-]+$/','message'=>'{attribute}必须是字母、数字、下划线或破折号'],
            [['listsort'], 'integer'],
            ['status', 'in', 'range' => [0,1]],
            [['note'], 'string', 'max' => 500],
            [['rolekey'], 'unique'],
            [['create_time', 'update_time','data_scope'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => '角色名称',
            'rolekey' => '权限字符',
            'listsort' => '显示顺序',
            'data_scope' => '数据范围',
            'status' => '角色状态',
            'note' => '备注',
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
