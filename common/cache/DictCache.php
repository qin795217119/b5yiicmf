<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\cache;

use common\services\DictDataService;
use common\services\DictTypeService;
use common\helpers\commonApi;
use Yii;

class DictCache
{
    /**
     * 获取某个字典类型下得数据列表及数据名
     * @param string|null $type 字典类型
     * @param string|null $value 数据值
     * @param bool $valid 是否只取有效数据
     * @return array|null
     */
    public static function get(string $type=null,string $value=null,bool $valid=true){
        if(!commonApi::paramSet($type)){
            return null;
        }
        $lists=Yii::$app->cache->getOrSet('dict_datalist',function (){
            $list=(new DictDataService())->getAll([],['type','name','value','status'],[],'',[['type','asc'],['listsort','asc'],['id','asc']]);
            return $list?:[];
        });

        $list=[];
        foreach ($lists as $val){
            if($val['type']==$type){
                $list[$val['value']]=$val;
            }
        }

        if(commonApi::paramSet($value)){
            return isset($list[$value])?$list[$value]['name']:null;
        }
        $dataList=[];
        if($list){
            foreach ($list as $value){
                if(!$valid || ($valid && $value['status']=='1')){
                    $dataList[$value['value']]=$value['name'];
                }
            }
        }
        return $dataList;
    }

    /**
     * 字典类型及获取类型名称
     * @param string $key
     * @return mixed|string
     */
    public static function getType(string $key=null){
        $list=Yii::$app->cache->getOrSet('dict_typelist',function (){
            $list= (new DictTypeService())->getAll([],['name','type'],[],'type,name');
            return $list?:[];
        });
        if(commonApi::paramSet($key)){
            return $list[$key]??null;
        }
        return $list;
    }

    /**
     * 清除所有
     */
    public static function clear(){
        Yii::$app->cache->delete('dict_typelist');
        Yii::$app->cache->delete('dict_datalist');
    }
}
