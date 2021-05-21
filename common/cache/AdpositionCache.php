<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\cache;

use common\models\Adposition;
use Yii;
use yii\helpers\ArrayHelper;

class AdpositionCache
{

    /**
     * 位置列表及获取对应键的信息
     * @param string|null $index
     * @param string|null $key
     * @param bool $showTitle
     * @return array|mixed|string
     */
    public static function get(string $index = null, string $key = null, bool $showTitle = false)
    {
        $list = Yii::$app->cache->getOrSet('adpositon_list', function () {
            $list = Adposition::find()->select(['title', 'type', 'width', 'height', 'note', 'id'])->asArray()->all();
            return $list ?: [];
        });
        if ($index) {
            $list = ArrayHelper::index($list, $index);
        }
        if ($key) {
            if ($showTitle) {
                return isset($list[$key]) ? $list[$key]['title'] : '';
            } else {
                return isset($list[$key]) ? $list[$key] : [];
            }
        }
        return $list;
    }

    /**
     * 清除所有
     */
    public static function clear()
    {
        Yii::$app->cache->delete('adpositon_list');
    }
}
