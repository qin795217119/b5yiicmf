<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\cache;

use common\models\DictData;
use common\models\DictType;
use common\helpers\commonApi;
use Yii;
use yii\helpers\ArrayHelper;

class DictCache
{
    /**
     * 获取某个字典类型下的数据列表及数据名
     * @param string|null $type 字典类型
     * @param string|null $value 数据值
     * @param bool $valid 是否只取有效数据
     * @return array|null
     */
    public static function get(string $type = null, string $value = null, bool $valid = true)
    {
        if (!commonApi::paramSet($type)) {
            return null;
        }
        $typeInfo = self::getType($type,false);
        if(!$typeInfo) return null;

        $lists = Yii::$app->cache->getOrSet('dict_datalist', function () {
            $list = DictData::find()->select(['id', 'parent_id', 'name', 'value', 'status'])->orderBy('listsort asc,id asc')->asArray()->all();
            return $list ?: [];
        });

        $list = [];
        foreach ($lists as $val) {
            if ($val['parent_id'] == $typeInfo['id']) {
                $list[$val['value']] = $val;
            }
        }

        if (commonApi::paramSet($value)) {
            return isset($list[$value]) ? $list[$value]['name'] : null;
        }
        $dataList = [];
        if ($list) {
            foreach ($list as $value) {
                if (!$valid || ($valid && $value['status'] == '1')) {
                    $dataList[$value['value']] = $value['name'];
                }
            }
        }
        return $dataList;
    }

    /**
     * 字典类型及获取类型名称
     * @param string|null $key
     * @param bool $isId
     * @return mixed|null
     */
    public static function getType(string $key = null, bool $isId = false)
    {
        $list = Yii::$app->cache->getOrSet('dict_typelist', function () {
            $list = DictType::find()->select(['id', 'type', 'name'])->orderBy('listsort asc,id asc')->asArray()->all();
            return $list ?: [];
        });

        if (commonApi::paramSet($key)) {
            if ($isId) {
                $list = ArrayHelper::index($list, 'id');

            } else {
                $list = ArrayHelper::index($list, 'type');
            }
            return $list[$key] ?? null;
        }
        return $list;
    }

    /**
     * 清除所有
     */
    public static function clear()
    {
        Yii::$app->cache->delete('dict_typelist');
        Yii::$app->cache->delete('dict_datalist');
    }
}
