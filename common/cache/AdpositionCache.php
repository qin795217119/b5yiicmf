<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\cache;

use common\services\AdpositionService;
use common\helpers\commonApi;
use Yii;

class AdpositionCache
{
    /**
     * 位置列表及位置名称
     * @param string $key
     * @param bool $showTitle
     * @return mixed|string
     */
    public static function get(string $key=null,bool $showTitle=true){
        $list=Yii::$app->cache->getOrSet('adpositon_list',function (){
            $list= (new AdpositionService())->getAll([],['title','type','width','height','note'],[],'type');
            return $list?:[];
        });
        if(commonApi::paramSet($key)){
            if($showTitle){
                return isset($list[$key])?$list[$key]['title']:null;
            }
            return $list[$key]??null;
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
        Yii::$app->cache->delete('adpositon_list');
    }
}
