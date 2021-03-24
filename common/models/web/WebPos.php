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
 * This is the model class for table "b5net_web_pos".
 *
 * @property int $id
 * @property string $title 位置名称
 * @property string|null $note 备注
 * @property int $width 图片宽度
 * @property int $height 图片高度
 * @property string|null $create_time
 * @property string|null $update_time
 */
class WebPos extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_web_pos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 150, 'min' => 2],
            [['note'], 'string', 'max' => 255],
            [['note'], 'default', 'value' => ''],
            [['width','height'], 'default', 'value' => 0],
            [['width', 'height'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => '位置名称',
            'note' => '备注',
            'width' => '图片宽度',
            'height' => '图片高度'
        ];
    }
}
