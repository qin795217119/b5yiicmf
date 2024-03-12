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
        $query = DictType::find()->select(['name','type']);
        if(!$all) $query = $query->where(['status'=>'1']);
        $list = $query->asArray()->all()?:[];
        return $list?:[];
    }

    /**
     * 获取字典类型信息
     * @param string $type
     * @return DictType|null
     */
    public static function getDictTypeInfo(string $type = ''): ?DictType
    {
        if(!$type) return null;
        return DictType::findOne(['type'=>$type]);
    }

    /**
     * 删除某个类型数据
     * @param string $type
     * @return void
     */
    public static function deleteDictDataByType(string $type = '')
    {
        if(!$type) return;
        DictData::deleteAll(['type'=>$type]);
    }


    public static function getDictDataByType($type)
    {

    }
}
