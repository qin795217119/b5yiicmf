<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\cache;

use common\services\RedtypeService;
use common\helpers\commonApi;
use Yii;

class RedtypeCache
{
    /**
     * 获取跳转功能列表、某个功能信息
     * @param string|null $type 字典类型
     * @param bool $showTitle 数据值
     * @param bool $valid 是否只取有效数据
     * @return array|null
     */
    public static function get(string $type=null,bool $showTitle=false,bool $valid=false){
        $list=Yii::$app->cache->getOrSet('redtype_list',function (){
            $list= (new RedtypeService())->getAll([],['title','type','list_url','info_url','status'],[],'type');
            return $list?:[];
        });
        if(commonApi::paramSet($type)){
            if($showTitle){
                return isset($list[$type])?$list[$type]['title']:null;
            }
            return $list[$type]??null;
        }
        if($valid){
            foreach ($list as $key=>$item) {
                if($item['status']!='1'){
                    unset($list[$key]);
                }
            }
        }
        if($showTitle){
            $list=commonApi::arr_keymap($list,'type','title');
        }
        return $list;
    }

    /**
     * 清除所有
     */
    public static function clear(){
        Yii::$app->cache->delete('redtype_list');
    }
}
