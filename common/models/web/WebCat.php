<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\models\web;

use common\models\BaseModel;
use Yii;

/**
 * This is the model class for table "b5net_web_cat".
 *
 * @property int $id
 * @property string $name 栏目名称
 * @property int $parent_id 父级栏目
 * @property string $type 栏目类型
 * @property string|null $url 跳转外链
 * @property string|null $template_list 列表模板
 * @property string|null $template_info 详情模板
 * @property int $listsort 排序
 * @property int $status 状态
 * @property string|null $checkcode 选中标识
 * @property string|null $create_time
 * @property string|null $update_time
 */
class WebCat extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_web_cat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'url', 'template_list', 'template_info','checkcode','listsort'], 'trim'],
            [['name', 'type'], 'required'],
            [['name'], 'string', 'max' => 150, 'min' => 2],
            [['listsort', 'status'], 'integer'],
            ['status', 'in', 'range' => [0, 1]],
            [['parent_id','listsort'], 'default', 'value' => 0],
            [['create_time', 'update_time', 'redfunc','checkcode','parent_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => '栏目名称',
            'parent_id' => '父级栏目',
            'type' => '栏目类型',
            'url' => '跳转外链',
            'template_list' => '列表模板',
            'template_info' => '详情模板',
            'listsort' => '排序',
            'status' => '状态',
            'checkcode' => '选中标识',
        ];
    }
}
