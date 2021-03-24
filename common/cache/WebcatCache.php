<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\cache;

use common\helpers\commonApi;
use common\services\web\WebCatService;
use Yii;

class WebcatCache
{
    /**
     * 获取站点的所有菜单
     * @param null $id
     * @param bool $showTitle
     * @return array|mixed|null
     */
    public static function get($id=null,$showTitle=false)
    {
        $list=Yii::$app->cache->getOrSet('webcat_list',function (){
            $list=(new WebCatService())->getAll([],[],[],'id',[['parent_id','asc'],['listsort','asc'],['id','asc']]);
            return $list ?: [];
        });
        if(commonApi::paramSet($id)){
            if($showTitle){
                return isset($list[$id])?$list[$id]['name']:null;
            }
            return $list[$id]??null;
        }
        if($showTitle){
            $list=commonApi::arr_keymap($list,'id','name');
        }
        return $list;
    }

    /**
     * 相关清除
     */
    public static function clear()
    {
        Yii::$app->cache->delete('webcat_list');
    }
}
