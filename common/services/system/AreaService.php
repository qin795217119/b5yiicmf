<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;

use common\models\system\Area;

class AreaService
{
    /**
     * 获取区划信息
     * @param $code
     * @return array
     */
    public static function getAreaInfo($code): array
    {
        if(!$code) return [];
        $info = Area::findOne(['code'=>$code]);
        return $info?$info->toArray():[];
    }
    /**
     * 根据code获取列表
     * @param $code
     * @return array
     */
   public static function getListByPCode($code): array
   {
       if(!$code) $code = 0;
       $list = Area::find()->where(['p_code'=>$code,'status'=>'1'])->select(['code','name'])->orderBy('list_sort asc,code asc')->asArray()->all();
       return $list?:[];
   }
}