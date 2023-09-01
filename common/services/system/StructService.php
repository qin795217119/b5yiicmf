<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;

use common\models\system\Struct;
use yii\db\Expression;

class StructService
{

    /**
     * 当修改组织构架时，修改子类所有的parent_name和levels
     * @param $pid
     * @return bool
     */
    public static function updateExtendField($pid):bool{
        if(!$pid) return false;

        $parentInfo = Struct::findOne($pid);
        if(!$parentInfo) return false;

        $parent_name = trim($parentInfo['parent_name'].','.$parentInfo['name'],',');
        $levels = trim($parentInfo['levels'].','.$parentInfo['id'],',');
        $childList = Struct::find()->where(['parent_id' => $pid])->all();
        foreach ($childList as $child){
            if($child['parent_name']!=$parent_name || $child['levels']!=$levels){
                $child->parent_name = $parent_name;
                $child->levels = $levels;
                $res = $child->save(false);
                if($res){
                    self::updateExtendField($child['id']);
                }
            }
        }
        return true;
    }

    /**
     * 获取某个组织的所有子组织
     * @param $id
     * @param false $onlyId
     * @return array
     */
    public static function getChildList($id, $onlyId = false):array
    {
        $list = [];
        if ($id > 0) {
            $list = Struct::find()->where(new Expression('FIND_IN_SET("' . $id . '",levels)'))->asArray()->all();
            if($onlyId){
                $list= array_column($list,'id');
            }
        }
        return $list ?: [];
    }

    /**
     * 获取所有菜单，用于树形组件使用
     * @return array
     */
    public static function getList():array
    {
        $list = Struct::find()->select(['id', 'parent_id', 'name'])->orderBy('parent_id asc,list_sort asc,id asc')->asArray()->all();
        return $list?:[];
    }
}
