<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_redtype".
 *
 * @property int $id
 * @property string $title 名称
 * @property string|null $type 跳转标识
 * @property string|null $list_url 跳转模块连接
 * @property string|null $info_url 跳转信息链接
 * @property int $status
 * @property string|null $note 备注
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 */
class Redtype extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_redtype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'type', 'status', 'list_url', 'info_url'], 'trim'],
            [['title', 'type'], 'required'],
            [['title', 'type'], 'string', 'max' => 100],
            ['type','match', 'pattern' => '/^[A-Za-z0-9_-]+$/','message'=>'{attribute}必须是字母、数字、下划线或破折号'],
            [['type'], 'unique'],
            ['status', 'in', 'range' => [0,1]],
            [['list_url', 'info_url', 'note'], 'string', 'max' => 255],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => '跳转名称',
            'type' => '跳转标识',
            'list_url' => '跳转模块连接',
            'info_url' => '跳转信息链接',
            'status' => '状态',
            'note' => '备注'
        ];
    }
}
