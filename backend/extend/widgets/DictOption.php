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
 * 展示下拉列表，单选等
 */
class DictOption extends Widget
{
    public string $type = ''; // 字典类型
    public string $value = ''; // 字典值
    public string $tag = ''; // 标签 默认为select 只返回option
    public string $name = ''; // 当tag为radio和checkbox时指定name值
    public bool $default = false; // 当value值为空字符串时，是否获取默认值作为选中值
    public bool $all = false; // 是否展示禁用的


    public function run(): string
    {
        $tagArr = ['radio', 'checkbox', 'select'];
        if (!$this->type || ($this->tag && !in_array($this->tag, $tagArr))) return '';

        $list = DictService::getDictDataByType($this->type);
        if (!$list) return '';
        $html = '';
        foreach ($list as $dict) {
            if ($dict['status'] != '1' && !$this->all) continue;
            if ($this->value === '') {
                $isCheck = false;
                if ($this->default && $dict['is_default'] == 'Y') $isCheck = true;
            } else {
                $isCheck = $this->value == $dict['value'];
            }

            if ($this->tag == 'radio') {
                $html .= '<label class="radio-box"><input type="radio" name="' . $this->name . '" value="' . $dict['value'] . '" ' . ($isCheck ? 'checked' : '') . '/> ' . $dict['title'] . '</label>';
            }
            elseif ($this->tag == 'checkbox') {
                $html .= '<label class="checkbox-box"><input type="checkbox" name="' . $this->name . '[]" value="' . $dict['value'] . '" ' . ($isCheck ? 'checked' : '') . '/> ' . $dict['title'] . '</label>';
            }
            else {
                $html .= '<option value="' . $dict['value'] . '" ' . ($isCheck ? 'selected' : '') . '>' . $dict['title'] . '</option>';
            }
        }
        return $html;
    }

}