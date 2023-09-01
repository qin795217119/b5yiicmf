<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\models\system;

/**
 * This is the model class for table "b5net_admin_view".
 * 管理员表的视图表 用于查询关联struct和role
 *
 * @property int $id
 * @property string $username 登录名
 * @property string $password 登录密码
 * @property string $realname 人员姓名
 * @property string $status 状态
 * @property string $shorter 简称
 * @property string $list_sort 排序
 * @property string $worker 是否参与计件
 * @property int $level 等级ID
 * @property string|null $note 备注
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 * @property string|null $last_time 登录时间
 * @property string|null $last_ip 登录ip
 *
 * @property string|null $role_id 角色
 * @property string|null $struct_id 组织
 * @property string|null $struct_id_tree 组织架构数
 */
class AdminView extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'b5net_admin_view';
    }

    //CREATE VIEW b5net_admin_view as ( SELECT a.*, d.struct_id_tree,d.struct_id,GROUP_CONCAT(r.role_id) as role_id FROM b5net_admin a  LEFT JOIN b5net_admin_role r ON a.id = r.admin_id LEFT JOIN ( select b.admin_id,GROUP_CONCAT( CONCAT(c.levels,',',c.id)) as struct_id_tree,GROUP_CONCAT(c.id) as struct_id from b5net_admin_struct b INNER JOIN b5net_struct c ON c.id = b.struct_id GROUP BY b.admin_id) d ON a.id = d.admin_id GROUP BY a.id)

}
