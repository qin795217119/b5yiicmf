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
 * This is the model class for table "b5net_web_ad".
 *
 * @property int $id
 * @property string $title 广告名称
 * @property int $pos_id 广告位置
 * @property string|null $linkurl 跳转链接
 * @property string|null $text_text 文本信息
 * @property string|null $text_rich 富文本信息
 * @property string|null $imglist 图片信息
 * @property int $listsort 排序
 * @property int $status 状态
 * @property string|null $create_time
 * @property string|null $update_time
 */

class WebAd extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_web_ad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','pos_id'], 'required'],
            [['title'], 'string', 'max' => 150, 'min' => 2],
            [['linkurl'], 'string', 'max' => 255],
            [['text_text','text_rich','imglist','linkurl'], 'default', 'value' => ''],
            ['imglist', 'filter', 'filter' => function ($value) {
                return $value ? (is_array($value) ? implode(',', $value) : $value) : '';
            }],
            [['listsort'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 1],
            [['pos_id', 'listsort','status'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => '广告名称',
            'pos_id' => '广告位置',
            'linkurl' => '跳转链接',
            'listsort' => '排序',
            'status' => '状态',
            'text_text' => '文本信息',
            'text_rich' => '富文本信息',
            'imglist' => '图片信息',
        ];
    }
}
