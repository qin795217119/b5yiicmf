<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;

use common\models\system\Menu;

class MenuService
{
    /**
     * 菜单类型
     * @return array
     */
    public static function typeList():array
    {
        return ['M' => '目录', 'C' => '菜单', 'F' => '按钮'];
    }

    /**
     * 获取所有菜单，用于树形组件使用
     * @param bool $root
     * @return array
     */
    public static function getList(bool $root = false):array
    {
        $list = Menu::find()->select(['id', 'parent_id', 'name'])->orderBy('parent_id asc,list_sort asc , id asc')->asArray()->all();
        if ($root) {
            $first = [
                'id' => 0,
                'parent_id' => -1,
                'name' => '顶级菜单'
            ];
            array_unshift($list, $first);
        }
        return $list;
    }
}