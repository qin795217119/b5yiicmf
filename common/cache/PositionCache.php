<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\cache;

use common\models\system\Position;

class PositionCache
{
    /**
     * 获取
     * @param string|null $id
     * @return array|mixed
     */
    public static function get(string $id=null)
    {
        if(!$id) return [];
        $list = static::lists();
        $list = $list?array_column($list,null,'id'):[];
        return isset($list[$id])?$list[$id]:[];
    }

    /**
     *
     * @return array
     */
    public static function lists(): array
    {
        return \Yii::$app->cache->getOrSet('position_list', function () {
            $lists = Position::find()->select(['id', 'name', 'poskey', 'status'])->orderBy('listsort asc,id asc')->asArray()->all();
            return $lists?:[];
        });
    }

    /**
     * 清除所有
     */
    public static function clear(): void
    {
        \Yii::$app->cache->delete('position_list');
    }
}
