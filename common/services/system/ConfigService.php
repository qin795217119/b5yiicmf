<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;


use common\helpers\Functions;
use common\models\system\Config;

class ConfigService
{

    /**
     * 配置类型
     * @return string[]
     */
    public function styleList():array
    {
        return ['text' => '文本', 'textarea' => '多行文本', 'array' => '数组', 'select' => '枚举'];
    }

    /**
     * 获取配置信息
     * @param string $key
     * @param bool $isVal
     * @return array|false|string[]|null
     */
    public function getConfig(string $key, bool $isVal = true)
    {
        if(!$key) {
            return false;
        }
        $info = Config::findOne(['type' => $key]);
        if (!$info) {
            return false;
        }
        $info = $this->formatFilter($info->toArray());
        if ($isVal) {
            return $info['value'];
        } else {
            return $info;
        }
    }

    /**
     * 对配置的数组和枚举进行处理
     * @param array $info
     * @param bool $array 是否处理数组
     * @return array
     */
    public function formatFilter(array $info,bool $array = true):array
    {
        if (empty($info)) return [];
        $value = $info['value'];
        if ($info['style'] == 'array' && $array) {
            if ($value) {
                $value = Functions::strLineToArray($value, ':');
            }
            $value = $value ?: [];
        }
        $info['value'] = $value;

        $extra = $info['extra'];
        if ($info['style'] == 'select') {
            if ($extra) {
                $extra = Functions::strLineToArray($extra, ':');
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
    public function getListByGroup(string $key = ''):array
    {
        $reList = [];
        $groupList = $this->getConfig('sys_config_group');
        if ($key && isset($groupList[$key])) {
            $groupList = [$key => $groupList[$key]];
        }

        if ($groupList) {
            $groupsKey = array_keys($groupList);
            if ($groupsKey) {
                $lists = Config::find()->where(['groups' => $groupsKey])->asArray()->all();
                if ($lists) {
                    foreach ($groupList as $gKey => $gTitle) {
                        $reList[$gKey] = [
                            'title' => $gTitle,
                            'chList' => []
                        ];
                        foreach ($lists as $key => $val) {
                            if ($val['groups'] == $gKey) {
                                $val = $this->formatFilter($val,false);
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
}
