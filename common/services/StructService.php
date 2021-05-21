<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;

use common\models\Struct;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * 组织架构
 * Class StructService
 * @package App\Services
 */
class StructService
{

    /**
     * 获取第一个组织架构ID
     * @return int
     */
    public static function getFirstId()
    {
        $info = Struct::find()->select(['id'])->where(['parent_id'=>0])->orderBy('id asc')->one();
        return $info ? $info['id'] : 0;
    }

    /**
     * 获取某个组织的所有子组织
     * @param $id
     * @param bool $onlyId
     * @return array
     */
    public static function getChildList($id, $onlyId = false)
    {
        $list = [];
        if ($id > 0) {
            $list = Struct::find()->where(new Expression('FIND_IN_SET("' . $id . '", levels)'))->asArray()->all();
            if($onlyId){
                $list= ArrayHelper::getColumn($list,'id');
            }
        }
        return $list ?: [];
    }
}
