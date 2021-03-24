<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_struct".
 *
 * @property int $id 部门id
 * @property string|null $name 部门名称
 * @property int|null $parent_id 父部门id
 * @property string|null $levels 祖级列表
 * @property int|null $listsort 显示顺序
 * @property string|null $leader 负责人
 * @property string|null $phone 联系电话
 * @property string|null $note 备注
 * @property string|null $status 部门状态（1正常 0停用）
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 */
class Struct extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_struct';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'leader', 'phone', 'listsort', 'status'], 'trim'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 30,'min'=>2],
            [['listsort'], 'integer'],
            [['leader'], 'string', 'max' => 20],
            [['phone'], 'string', 'max' => 11],
            [['note'], 'string', 'max' => 255],
            ['status', 'in', 'range' => [0,1]],
            [['create_time', 'update_time', 'levels', 'parent_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => '部门名称',
            'listsort' => '显示顺序',
            'leader' => '负责人',
            'phone' => '联系电话',
            'note' => '备注',
            'status' => '部门状态'
        ];
    }

    public function getFirst(){
        return self::find()->select(['id'])->orderBy('id asc')->one();
    }
}
