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
 * 获取字典列表，用于前端快速获取json
 */
class DictList extends Widget
{
    public string $type = ''; // 字典类型
    public bool $all = false; // 是否展示禁用的


    public function run(): string
    {
        $list = DictService::getDictDataByType($this->type);
        if($this->all && $list) {
            $newList = [];
            foreach ($list as $value) {
                if ($value['status'] == '1') $newList[] = $value;
            }
            return json_encode($newList);
        }

        return json_encode($list);
    }

}