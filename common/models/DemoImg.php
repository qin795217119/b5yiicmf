<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_demo_img".
 *
 * @property int $id
 * @property string|null $img1
 * @property string|null $img2
 * @property string|null $img3
 * @property string|null $video
 * @property string|null $create_time
 * @property string|null $update_time
 */
class DemoImg extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_demo_img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img2'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['img1', 'img3', 'video'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img1' => 'Img1',
            'img2' => 'Img2',
            'img3' => 'Img3',
            'video' => 'video',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
