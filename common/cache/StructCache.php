<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\cache;


use common\models\system\Struct;

class StructCache
{
    /**
     * 获取某个信息
     * @param string $id
     * @return array
     */
    public static function info($id = ''): array
    {
        if (!$id) return [];
        $list = static::lists(true);
        return $list[$id] ?? [];
    }

    /**
     * 列表
     * @param bool $index
     * @return array
     */
    public static function lists(bool $index = false): array
    {
        $list =  \Yii::$app->cache->getOrSet('struct_list', function () {
            $lists = Struct::find()->select(['id', 'name', 'parent_id', 'status'])->orderBy('parent_id asc,list_sort asc,id asc')->asArray()->all();
            return $lists?:[];
        });
        if($index && $list){
            $list = array_column($list,null,'id');
        }
        return $list?:[];
    }

    /**
     * 清除所有
     */
    public static function clear(): void
    {
        \Yii::$app->cache->delete('struct_list');
    }
}
