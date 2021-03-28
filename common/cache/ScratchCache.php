<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\cache;

use common\services\scratch\ScratchService;
use Yii;

class ScratchCache
{
    public function info($id){
        return self::get($id,false);
    }
    public static function get($id,$showTitle=false)
    {
        if(!$id) return [];
        $info=Yii::$app->cache->getOrSet('scratch_info_'.$id,function () use ($id){
            $infos=(new ScratchService())->info($id);
            return $infos ?: [];
        });
        if($showTitle){
            return $info?$info['title']:'';
        }
        return $info;
    }

    /**
     * 相关清除
     */
    public static function clear($id)
    {
        if($id){
            $idArr = explode(',', $id);
            if($idArr){

                foreach ($idArr as $idval){
                    if($idval){
                        Yii::$app->cache->delete("scratch_info_".$idval);
                    }
                }
            }
        }
    }
}
