<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\modules\demo\models;


/**
 * This is the model class for table "demo_media".
 *
 * @property int $id
 * @property string|null $img
 * @property string|null $imgs
 * @property string|null $crop
 * @property string|null $video
 * @property string|null $file
 * @property string|null $files
 * @property string|null $create_time
 * @property string|null $update_time
 */
class Media extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'demo_media';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img2'], 'string'],
            [['img','imgs','crop','video','file','files','create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => '单图片',
            'imgs' => '多图片',
            'crop' => '裁剪图片',
            'video' => '商品',
            'file' => '单文件',
            'files' => '多文件',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
