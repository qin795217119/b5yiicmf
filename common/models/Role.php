<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_role".
 *
 * @property int $id 角色ID
 * @property string $name 角色名称
 * @property string $rolekey 角色权限字符串
 * @property int $listsort 显示顺序
 * @property string $status 角色状态（1正常 0停用）
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 * @property string|null $note 备注
 */
class Role extends BaseModel
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
            [['create_time', 'update_time'], 'safe'],
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
            'status' => '角色状态',
            'note' => '备注',
        ];
    }

    public function getMenus(){
        return $this->hasMany(RoleMenu::className(), ['role_id' => 'id']);
    }
}
