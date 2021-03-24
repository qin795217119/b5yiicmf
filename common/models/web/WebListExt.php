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
 * This is the model class for table "b5net_web_list_ext".
 *
 * @property int $id
 * @property string|null $content 富文本信息
 * @property string|null $imglist 图片列表
 * @property int|null $catid
 */
class WebListExt extends BaseModel
{
    public $timestamps=false;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_web_list_ext';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['content', 'imglist', 'catid'], 'safe'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '富文本信息',
            'imglist' => '图片列表',
            'catid' => 'Catid',
        ];
    }
}
