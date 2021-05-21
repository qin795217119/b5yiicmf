<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;


use common\models\DictType;

/**
 * 字典分类
 * Class DictTypeService
 * @package App\Services
 */
class DictTypeService
{

    /**
     * 获取字典类型列表
     * @return mixed
     */
    public static function getTypeList()
    {
        return DictType::find()->select(['id','type', 'name'])->orderBy('listsort asc,id asc')->asArray()->all();
    }


}
