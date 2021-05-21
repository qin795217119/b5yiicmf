<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;


use common\cache\ConfigCache;
use common\helpers\commonApi;
use common\models\Config;

/**
 * 系统配置
 * Class ConfigService
 * @package App\Services
 */
class ConfigService
{

    /**
     * 配置类型
     * @param null $type
     * @return array|mixed|string
     */
    public static function styleList($type = null)
    {
        $styleList = ['text' => '文本', 'textarea' => '多行文本', 'array' => '数组', 'select' => '枚举'];
        if (!is_null($type)) {
            return $styleList[$type] ?? '';
        }
        return $styleList;
    }

    /**
     * 获取配置信息
     * @param string $key
     * @param bool $isVal
     * @return array|false|string[]|null
     */
    public static function getConfig(string $key, bool $isVal = true)
    {
        if (empty($key)) return null;
        $info = Config::findOne(['type' => $key]);
        if (empty($info)) return null;
        $info = $info->toArray();
        $info = self::formatConfig($info);
        if ($isVal) {
            return $info['value'];
        } else {
            return $info;
        }
    }

    /**
     * 对配置的数组和枚举进行处理
     * @param $info
     * @param bool $changeArr 是否对数组进行解析
     * @return array
     */
    public static function formatConfig($info, bool $changeArr = true)
    {
        if (empty($info)) return [];
        $value = $info['value'];
        if ($info['style'] == 'array' && $changeArr) {
            if ($value) {
                $value = commonApi::strLineToArray($value, ':');
            }
            $value = $value ?: [];
        }
        $info['value'] = $value;

        $extra = $info['extra'];
        if ($info['style'] == 'select') {
            if ($extra) {
                $extra = commonApi::strLineToArray($extra, ':');
            }
            $extra = $extra ?: [];
        }
        $info['extra'] = $extra;
        return $info;
    }

    /**
     * 获取分组的配置列表
     * @param string $key
     * @return array
     */
    public static function getListByGroup(string $key = '')
    {
        $reList = [];
        $groupList = self::getConfig('sys_config_group');
        if ($key && isset($groupList[$key])) {
            $groupList = [$key => $groupList[$key]];
        }
        if ($groupList) {
            $groupsKey = array_keys($groupList);
            if ($groupsKey) {
                $lists = Config::find()->where(['groups' => $groupsKey])->orderBy('listsort asc,id asc')->asArray()->all();
                if ($lists) {
                    foreach ($groupList as $gKey => $gTitle) {
                        $reList[$gKey] = [
                            'title' => $gTitle,
                            'chList' => []
                        ];
                        foreach ($lists as $key => $val) {
                            if ($val['groups'] == $gKey) {
                                $val = self::formatConfig($val, false);
                                $reList[$gKey]['chList'][$val['type']] = $val;
                                unset($lists[$key]);
                            }
                        }
                    }
                }
            }
        }
        return $reList;
    }


    /**
     * 清除缓存
     * @return array
     */
    public function delcache()
    {
        ConfigCache::clear();
        return commonApi::message('清理缓存完成', true);
    }


}
