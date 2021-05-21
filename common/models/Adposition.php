<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models;

use Yii;

/**
 * This is the model class for table "b5net_adposition".
 *
 * @property int $id
 * @property string $type 唯一标识
 * @property string $title 位置名称
 * @property string $note 备注
 * @property int $width
 * @property int $height
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 */
class Adposition extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_adposition';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'type', 'width', 'height'], 'trim'],
            [['title','type'],'required'],
            [['type', 'title'], 'string','min'=>2, 'max' => 50],
            [['note'], 'string', 'max' => 255],
            ['type','match', 'pattern' => '/^[A-Za-z0-9_-]+$/','message'=>'{attribute}必须是字母、数字、下划线或破折号'],
            [['type'], 'unique'],
            [['width', 'height'],'integer'],
            [['width', 'height'],'default','value'=>0],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type' => '位置标识',
            'title' => '位置名称',
            'note' => '备注',
            'width' => '宽度',
            'height' => '高度'
        ];
    }

    public function afterDelete()
    {
        parent::afterDelete();
        if($this->id){
            Adlist::deleteAll(['parent_id'=>$this->id]);
        }
    }
}
