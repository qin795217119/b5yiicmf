<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\services\system;
use common\models\system\Role;

class RoleService
{
    /**
     * 获取角色列表
     * @return array
     */
    public static function getList():array{
        $list = Role::find()->orderBy('list_sort asc,id asc')->asArray()->all();
        return $list?:[];
    }
}
