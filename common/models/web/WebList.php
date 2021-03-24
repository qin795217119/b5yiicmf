<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models\web;

use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "b5net_web_list".
 *
 * @property int $id
 * @property string $title 标题
 * @property string|null $remark 简介
 * @property int $status 状态
 * @property string|null $author 作者
 * @property string|null $froms 来源
 * @property string|null $thumbimg 缩略图
 * @property int $catid 所属菜单ID
 * @property int|null $click 点击量
 * @property string|null $linkurl 外链地址
 * @property string|null $create_time
 * @property string|null $update_time
 * @property string|null $subtime 发布时间
 */
class WebList extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_web_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','catid'], 'required'],
            [['title'], 'string', 'max' => 150],
            [['status', 'catid'], 'integer'],
            [['remark'], 'string', 'max' => 200],
            [['author', 'froms'], 'string', 'max' => 50],
            [['linkurl'], 'string', 'max' => 255],
            [['create_time', 'update_time', 'thumbimg','click','subtime'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'remark' => '简介',
            'status' => '状态',
            'author' => '作者',
            'froms' => '来源',
            'thumbimg' => '缩略图',
            'catid' => '所属菜单ID',
            'click' => '点击量',
            'linkurl' => '外链地址',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'subtime' => '发布时间',
        ];
    }
}
