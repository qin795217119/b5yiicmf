<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_adlist".
 *
 * @property int $id
 * @property string $title 信息标题
 * @property string $adtype 推荐位置
 * @property string $redtype 跳转类型
 * @property string|null $redfunc 跳转模块
 * @property string|null $redinfo 跳转值
 * @property int $listsort 排序
 * @property int $status 状态
 * @property string|null $text_text 文本信息
 * @property string|null $text_rich 富文本信息
 * @property string|null $imglist 图片信息
 * @property string|null $create_time
 * @property string|null $update_time
 */
class Adlist extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_adlist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['adtype', 'title', 'redtype', 'redfunc', 'redinfo', 'listsort'], 'trim'],
            [['adtype', 'title', 'redtype'], 'required'],
            [['title'], 'string', 'max' => 150, 'min' => 2],
            [['listsort', 'status'], 'integer'],
            ['status', 'in', 'range' => [0, 1]],
            ['imglist', 'filter', 'filter' => function ($value) {
                return $value ? (is_array($value) ? implode(',', $value) : $value) : '';
            }],
            [['redinfo'], 'string', 'max' => 500],
            [['text_text', 'text_rich', 'imglist'], 'string'],
            [['create_time', 'update_time', 'redfunc'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => '信息标题',
            'adtype' => '推荐位置',
            'redtype' => '跳转类型',
            'redfunc' => '跳转模块',
            'redinfo' => '跳转值',
            'listsort' => '排序',
            'status' => '状态',
            'text_text' => '文本信息',
            'text_rich' => '富文本信息',
            'imglist' => '图片信息'
        ];
    }
}
