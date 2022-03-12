<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: b5net <357145480@qq.com>
// +----------------------------------------------------------------------
// 获取配置值使用  ConfigCache::get('配置标识')
// 若获取枚举选项  ConfigCache::get('配置标识',false)
// +----------------------------------------------------------------------
namespace common\cache;

use common\models\Role;
use common\models\RoleStruct;
use Yii;
use yii\helpers\ArrayHelper;

class RoleCache
{
    public static function lists(string $id=null){
        $list=Yii::$app->cache->getOrSet('role_list',function (){
            $lists = Role::find()->select(['id','rolekey','name','status','data_scope'])->orderBy('listsort asc,id asc')->indexBy('id')->asArray()->all();
            foreach ($lists as $key=>$value){
                $structs = '';
                if($value['data_scope']==8){//自定义
                    $structs = RoleStruct::find()->where(['role_id'=>$value['id']])->asArray()->all();
                    if($structs){
                        $structs = ArrayHelper::getColumn($structs,'struct_id');
                    }
                }
                $lists[$key]['structs'] = $structs?implode(',',$structs):'';
            }
            return $lists?:[];
        });
        if(is_null($id)){
            return $list;
        }else{
            return $list[$id]??[];
        }
    }

    public static function showList(){
        $lists = self::lists();
        $list = [];
        foreach ($lists as $val){
            if($val['status']==1){
                $list[$val['id']]=$val['name'];
            }
        }
        return $list;
    }

    /**
     * 清除所有
     */
    public static function clear(){
        Yii::$app->cache->delete('role_list');
    }
}
