<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\models\system;

/**
 * This is the model class for table "b5net_menu".
 *
 * @property int $id 菜单ID
 * @property string $name 菜单名称
 * @property int $parent_id 父菜单ID
 * @property int $list_sort 显示顺序
 * @property string $url 请求地址
 * @property int $target 打开方式（0页签 1新窗口）
 * @property string $type 菜单类型（M目录 C菜单 F按钮）
 * @property string $status 菜单状态（1显示 0隐藏）
 * @property string $is_refresh 是否刷新（0不刷新 1刷新）
 * @property string $perms 权限标识
 * @property string $icon 菜单图标
 * @property string $note 备注
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'url', 'perms', 'icon', 'status', 'list_sort', 'parent_id', 'target', 'is_refresh'], 'trim'],
            [['name', 'type'], 'required'],
            [['name'], 'string', 'max' => 30, 'min' => 2],
            [['url'], 'string', 'max' => 200],
            [['perms', 'icon'], 'string', 'max' => 100],
            [['status', 'is_refresh'], 'in', 'range' => [0, 1]],
            [['note'], 'string', 'max' => 500],
            [['list_sort'], 'integer'],
            [['create_time', 'update_time', 'parent_id', 'target'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '菜单ID',
            'name' => '菜单名称',
            'parent_id' => '父菜单ID',
            'list_sort' => '显示顺序',
            'url' => '请求地址',
            'target' => '打开方式（0页签 1新窗口）',
            'type' => '菜单类型（M目录 C菜单 F按钮）',
            'status' => '菜单状态（1显示 0隐藏）',
            'is_refresh' => '是否刷新（0不刷新 1刷新）',
            'perms' => '权限标识',
            'icon' => '菜单图标',
            'note' => '备注',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value' => function () {
                    return (new \DateTime())->format('Y-m-d H:i:s');
                }
            ]
        ];
    }
}
