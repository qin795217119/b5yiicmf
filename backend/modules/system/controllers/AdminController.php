<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\modules\system\controllers;


use backend\extend\BaseController;
use backend\extend\traits\CommonAction;
use common\cache\PositionCache;
use common\extend\tools\PageUtils;
use common\extend\tools\QueryUtils;
use common\models\system\AdminView;
use common\services\system\AdminPosService;
use common\services\system\AdminRoleService;
use common\services\system\AdminStructService;
use common\services\system\RoleService;
use common\services\system\StructService;
use common\models\system\Admin;

class AdminController extends BaseController
{
    use CommonAction;

    protected string $model = Admin::class;
    protected bool $validate = true;

    /**
     * 选择人员视图
     * @return string
     */
    public function actionTree(): string
    {
        $mult = $this->request->get('mult', '0'); // 是否多选 1多选 非1单选，默认单选
        $ids = $this->request->get('ids', ''); // 默认选中的
        $checkDisabled = $this->request->get('check_disabled',''); // 多选时，是否进制取消选中
        return $this->render('', ['user_ids' => $ids, 'mult' => $mult, 'check_disabled'=>$checkDisabled]);
    }

    /**
     * 人员视图获取人员列表
     * @return array|string
     * @throws \Exception
     */
    public function actionAjaxtreelist()
    {
        if (!$this->request->isPost) {
            return $this->error('请求类型错误');
        }
        $post = $this->request->post();

        //使用in查询
//        $params = $this->listStructParse($post);
//        $query = Admin::find();

        //使用视图查询
        $result = $this->viewQuery($post);
        if ($result) {
            $params = $result;
            $query = AdminView::find();
        } else {
            $query = Admin::find();
        }

        $params['where']['status'] = 1;
        $params['field'] = 'id,realname,status,create_time';

        $root_id = intval($this->app->params['root_admin_id']);

        $queryUtils = new QueryUtils($query, $params);
        $pageUtils = new PageUtils('pageNum', 'pageSize');

        $query = $queryUtils->whereParse()->fieldParse()->orderParse()->getQuery();
        $query = $query->andWhere(['<>', 'id', $root_id]);

        $count = $query->count();
        $query = $query->offset($pageUtils->getOffset())->limit($pageUtils->getPageSize());
        $list = $this->indexAfter($query->asArray()->all());
        return $this->success('操作成功', $list, ['total' => $count]);
    }

    /**
     * 首页渲染
     * @return string
     */
    protected function indexRender(): string
    {
        $root_id = intval($this->app->params['root_admin_id']);
        $roleList = RoleService::getList();
        return $this->render('', ['root_id' => $root_id, 'roleList' => $roleList]);
    }

    /**
     * 首页列表查询前条件处理
     * @param array $params
     * @return array
     */
    protected function indexBefore(array $params): array
    {
        //使用in 进行组织和角色处理
//        $params = $this->listStructParse($params);

        //使用视图查询
        $result = $this->viewQuery($params);
        if ($result) {
            $params = $result;
            $this->model = AdminView::class;
        }

        return $params;
    }

    /**
     * 使用视图方式查询，先通过下面sql创建b5net_admin_view视图
     * CREATE VIEW b5net_admin_view as ( SELECT a.*, d.struct_id_tree,d.struct_id,GROUP_CONCAT(r.role_id) as role_id FROM b5net_admin a  LEFT JOIN b5net_admin_role r ON a.id = r.admin_id LEFT JOIN ( select b.admin_id,GROUP_CONCAT( CONCAT(c.levels,',',c.id)) as struct_id_tree,GROUP_CONCAT(c.id) as struct_id from b5net_admin_struct b INNER JOIN b5net_struct c ON c.id = b.struct_id GROUP BY b.admin_id) d ON a.id = d.admin_id GROUP BY a.id)
     * 当会员大于1000时，使用原来的in 方法会sql过长
     * @param $params
     * @return array | false
     */
    protected function viewQuery(array $params)
    {
        $role_id = $params['role_id'] ?? '';
        $struct_id = $params['structId'] ?? '';
        $contains = $params['contains'] ?? 0;
        if ($struct_id || $role_id) {
            if ($role_id) $params['find']['role_id'] = $role_id;

            if ($struct_id) {
                if ($contains) {
                    if ($struct_id != $this->app->params['root_struct_id']) {
                        $params['find']['struct_id_tree'] = $struct_id;
                    }
                } else {
                    $params['where']['struct_id'] = $struct_id;
                }
            }
            return $params;
        }
        return false;
    }

    /**
     * 列表查询时，组织架构和角色查询处理
     * 查询出所有属于该组织或角色的用于ID，使用in查询
     * 用户超过1000会超出mysql的长度限制
     * @param $params
     * @return array|false
     */
    protected function listStructParse($params)
    {
        $userIdList = [];
        //角色处理
        $role_id = $params['role_id'] ?? '';
        if ($role_id) {
            $roleUserList = AdminRoleService::getAdminIdByRoleId($role_id);
            if (!$roleUserList) {
                $params['where']['id'] = 0;
                return $params;
            }
            $userIdList = $roleUserList;
        }

        //组织架构处理
        $structUserIdList = [];
        $contains = $params['contains'] ?? 0;
        $root_struct_id = intval($this->app->params['root_struct_id']);
        $struct_id = $params['structId'] ?? '';

        if ($struct_id) {
            $structList = [];
            if ($contains) {
                if ($root_struct_id != $struct_id) {
                    //获取所有子组织
                    $structList = StructService::getChildList($struct_id, true);
                    $structList[] = $struct_id;
                }
            } else {
                $structList[] = $struct_id;
            }

            if ($structList) {
                //获取组织下的用户
                $list = AdminStructService::getAdminIdByStructId($structList);
                $structUserIdList = $list ?: false;
            }
        }

        if ($structUserIdList === false) {
            $params['where']['id'] = -1;
            $userIdList = [];
        } elseif ($structUserIdList) {
            $userIdList = array_merge($userIdList, $structUserIdList);
        }

        if ($userIdList) {
            $params['in']['id'] = array_unique($userIdList);
        }
        return $params;
    }

    /**
     * 首页列表处理
     * @param array $list
     * @return array
     */
    protected function indexAfter(array $list): array
    {
        foreach ($list as $key => $value) {
            $structInfo = AdminStructService::getStructByAdminId($value['id'], true);

            $struct_name = '';
            if ($structInfo) {
                $structInfo = $structInfo[0];
                $struct_name = $structInfo['name'];
                if ($structInfo['parent_name']) {
                    $parent_name = explode(',', $structInfo['parent_name']);
                    $parent_name = array_pop($parent_name);
                    $struct_name = $parent_name . '/' . $struct_name;
                }
            }
            $value['struct_name'] = $struct_name;


            $roleList = AdminRoleService::getRoleByAdmin($value['id'], true);
            $roleList = $roleList ? array_column($roleList, 'name') : [];
            $value['role_name'] = implode(',', $roleList);

            $posInfo = AdminPosService::getPosByAdmin($value['id'], true);
            $value['pos_name'] = $posInfo ? $posInfo['name'] : '';
            $value['pos_key'] = $posInfo ? $posInfo['pos_key'] : '';

            $list[$key] = $value;
        }
        return $list;
    }

    /**
     * 添加页渲染
     * @return string
     */
    protected function addRender(): string
    {
        $roleList = RoleService::getList();
        $posList = PositionCache::lists();
        return $this->render('', ['roleList' => $roleList, 'posList' => $posList]);
    }

    /**
     * 编辑页渲染
     * @param Admin $model
     * @return string
     */
    protected function editRender(Admin $model): string
    {
        $structInfo = AdminStructService::getStructByAdminId($model->id, true);

        $struct_id = implode(',', array_column($structInfo, 'id'));
        $struct_name = implode(',', array_column($structInfo, 'name'));

        $roleId = AdminRoleService::getRoleByAdmin($model->id);
        $roleList = RoleService::getList();

        $posList = PositionCache::lists();
        $posId = AdminPosService::getPosByAdmin($model->id);
        return $this->render('', ['info' => $model, 'roleList' => $roleList, 'struct_id' => $struct_id, 'struct_name' => $struct_name, 'roleId' => $roleId, 'posList' => $posList, 'posId' => $posId]);
    }

    /**
     * 验证前进行数据处理
     * @param Admin $model
     * @param string $type
     * @return string
     */
    protected function validateBefore(Admin $model, string $type): string
    {
        if (isset($model->password) && !$model->password) {
            if ($type == 'add') {
                $model->password = '123456';
            } else if ($type == 'edit') {
                unset($model->password);
            }
            if (isset($model->realname) && !$model->realname) {
                $model->realname = $model->username;
            }
        }
        return '';
    }

    /**
     * 添加和编辑保存前对数据进行处理
     * @param Admin $model
     * @param string $type
     * @return string
     */
    protected function saveBefore(Admin $model, string $type): string
    {
        if ($type == 'add' || $type == 'edit') {
            if (isset($model->password)) {
                if (!$model->password) {
                    $model->password = $model->oldAttributes['password'];
                } else {
                    $model->password = md5($model->password);
                }
            }
        }
        return '';
    }

    /**
     * 添加和编辑后更新角色和组织信息
     * @param Admin $model
     * @param string $type
     */
    protected function saveAfter(Admin $model, string $type): void
    {
        if ($type == 'add' || $type == 'edit') {
            $roles = $this->request->post('roles', '');
            $struct = $this->request->post('struct', '');
            $pos = $this->request->post('pos', '');

            AdminRoleService::update($model->id, $roles);
            AdminStructService::update($model->id, $struct);
            AdminPosService::update($model->id, $pos);
        }
    }

    /**
     * 删除前判断
     * @param Admin $model
     * @return string
     */
    protected function deleteBefore(Admin $model): string
    {
        $root_id = intval($this->app->params['root_admin_id']);
        if ($model->id == $root_id) {
            return '默认超级管理员无法删除';
        }
        return '';
    }

    /**
     * 删除后操作
     * @param Admin $model
     */
    protected function deleteAfter(Admin $model): void
    {
        //删除管理员角色
        AdminRoleService::deleteByAdmin($model->id);

        //删除管理员组织部门
        AdminStructService::deleteByAdmin($model->id);

        //删除管理员岗位
        AdminPosService::deleteByAdmin($model->id);
    }
}
