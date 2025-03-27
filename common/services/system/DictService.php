<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;

use common\models\system\DictData;
use common\models\system\DictType;

class DictService
{
    /**
     * 获取字典类型列表
     * @param bool $all
     * @return array
     */
    public static function getDictTypeList(bool $all = false): array
    {
        $query = DictType::find()->select(['name', 'type']);
        if (!$all) $query = $query->where(['status' => '1']);
        $list = $query->asArray()->all() ?: [];
        return $list ?: [];
    }

    /**
     * 获取字典类型信息
     * @param string $type
     * @return DictType|null
     */
    public static function getDictTypeInfo(string $type = ''): ?DictType
    {
        if (!$type) return null;
        return DictType::findOne(['type' => $type]);
    }

    /**
     * 删除某个类型数据
     * @param string $type
     * @return void
     */
    public static function deleteDictDataByType(string $type = '')
    {
        if (!$type) return;
        DictData::deleteAll(['type' => $type]);
    }

    /**
     * 获取某个字典类型的数据列表
     * @param string $type
     * @param bool $json 是否返回json字符串
     * @return array|string
     */
    public static function getDictDataByType($type = '', $json = false)
    {
        if (!$type) return [];
        $list = DictData::find()->select(['id', 'title', 'value', 'list_class', 'css_class', 'is_default', 'status'])->where(['type' => $type])->orderBy('list_sort asc')->cache(20)->asArray()->all();
        return $json? json_encode($list ?: []) : ($list ?: []);
    }

    /**
     * 获取某个字典类型的某个值的信息
     * @param string $type
     * @param string $value
     * @return array
     */
    public static function getDictDataByTypeAndValue($type = '', $value = ''): array
    {
        if (!$type || !$value) return [];
        $info = DictData::find()->select(['id', 'title', 'value', 'list_class', 'css_class', 'is_default', 'status'])->where(['type' => $type, 'value' => $value])->orderBy('list_sort asc')->cache(20)->asArray()->one();
        return $info ?: [];
    }
}
