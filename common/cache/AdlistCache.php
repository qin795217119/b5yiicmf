<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\cache;

use common\helpers\commonApi;
use common\services\AdlistService;
use Yii;

class AdlistCache
{
    /**
     * 获取某个推荐位信息列表
     * @param string|null $type
     * @return |null
     */
    public static function get(string $type = null)
    {
        if (!commonApi::paramSet($type)) {
            return null;
        }
        $lists=Yii::$app->cache->getOrSet('adlist_list',function (){
            $lists = (new AdlistService())->getAll([['status' => '1']],['adtype','title','redtype','redfunc','redinfo','text_text','text_rich','imglist'],[],'',[['adtype','asc'],['listsort','asc'],['id','asc']]);

            foreach ($lists as $key=>$value){
                $value['url']='';
                switch ($value['redtype']){
                    case 'url':
                        $value['url']=$value['redinfo'];
                        break;
                    case 'func':
                        if($value['redfunc']){
                            $funcinfo=RedtypeCache::get($value['redfunc']);
                            $value['url']=$funcinfo?$funcinfo['list_url']:'';
                        }
                        break;
                    case 'info':
                        if($value['redfunc']){
                            $funcinfo=RedtypeCache::get($value['redfunc']);
                            $value['url']=($funcinfo?$funcinfo['info_url']:'').$value['redinfo'];
                        }
                        break;
                }
                $value['imglist']=commonApi::get_image_url($value['imglist']);
                $lists[$key]=$value;
            }
            return $lists ?: [];
        });
        $list=[];
        foreach ($lists as $info){
            if($info['adtype']==$type){
                $list[]=$info;
            }
        }
        return $list;
    }

    /**
     * 字典相关清除所有
     */
    public static function clear()
    {
        Yii::$app->cache->delete('adlist_list');
    }
}
