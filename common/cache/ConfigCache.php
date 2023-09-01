<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\cache;


use common\services\system\ConfigService;
use common\models\system\Config;

class ConfigCache
{
    /**
     * 获取配置值
     * @param string|null $type
     * @param null $default
     * @return false|mixed|null
     */
    public static function get(string $type = null, $default = null)
    {
        if (!$type) return false;
        $list = self::lists();
        return isset($list[$type]) ? $list[$type]['value'] : $default;
    }

    /**
     * 获取配置列表
     * @return array
     */
    public static function lists(): array
    {
        return \Yii::$app->cache->getOrSet('config_list', function () {
            $result = [];
            $lists = Config::find()->select(['type', 'value', 'extra', 'style'])->asArray()->all();
            if ($lists) {
                foreach ($lists as $key => $value) {
                    $result[$value['type']] = ConfigService::formatFilter($value);
                }
            }
            return $result;
        });
    }

    /**
     * 清除所有
     */
    public static function clear(): void
    {
        \Yii::$app->cache->delete('config_list');
    }
}
