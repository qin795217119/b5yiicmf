<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\extend\widgets;


use common\services\system\DictService;
use yii\base\Widget;

/**
 * 展示字典数据标签
 */
class Dict extends Widget
{
    public string $type = ''; // 字典类型
    public string $value = ''; // 字典值


    public function run(): string
    {
        if (!$this->type) return '';
        $data = DictService::getDictDataByTypeAndValue($this->type, $this->value);
        if (!$data) return '<span>'.$this->value.'</span>';
        return '<span class="label label-' . $data['list_class'] . ' ' . $data['css_class'] . '">' . $data['title'] . '</span>';
    }

}