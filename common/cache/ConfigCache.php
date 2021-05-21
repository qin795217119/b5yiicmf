<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// 获取配置值使用  ConfigCache::get('配置标识')
// 若获取枚举选项  ConfigCache::get('配置标识',false)
// +----------------------------------------------------------------------
namespace common\cache;

use common\models\Config;
use common\services\ConfigService;
use common\helpers\commonApi;
use Yii;

class ConfigCache
{
    /**
     * 获取配置值或枚举选项
     * @param string|null $type
     * @param bool $isVal true获取值 false获取枚举选项
     * @return mixed|null
     */
    public static function get(string $type=null,$isVal=true){
        $info=self::getType($type);
        if(empty($info)) return null;
        return $isVal?$info['value']:$info['extra'];
    }

    /**
     * 获取配置信息
     * @param string $type
     * @return mixed|string
     */
    public static function getType(string $type=null){
        if(!commonApi::paramSet($type)){
            return null;
        }
        $list=Yii::$app->cache->getOrSet('config_list',function (){
            $lists = Config::find()->select(['type','value','extra','style'])->asArray()->all();
            $list=[];
            if($lists){
                foreach ($lists as $info){
                    $list[$info['type']]=ConfigService::formatConfig($info);
                }
            }
            unset($lists);
            return $list;
        });
        $info=$list[$type]??[];
        return $info?:[];
    }

    /**
     * 清除所有
     */
    public static function clear(){
        Yii::$app->cache->delete('config_list');
    }
}
