<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace backend\modules\system\controllers;


use backend\extend\BaseController;
use backend\extend\traits\CommonAction;
use common\cache\PositionCache;
use common\models\system\AdminView;
use common\services\system\AdminPosService;
use common\services\system\AdminRoleService;
use common\services\system\AdminStructService;
use common\services\system\RoleService;
use common\services\system\StructService;
use common\models\system\Admin;
use yii\db\Query;

class AdminController extends BaseController
{
    use CommonAction;

    protected $model = Admin::class;
    protected $validate = true;

    /**
     * 选择人员视图
     * @return string
     */
    public function actionTree(){
        $mult = $this->request->get('mult',0);
        $ids = $this->request->get('ids', '');
        return $this->render('',['user_ids'=>$ids,'mult'=>$mult]);
    }

    /**
     * 人员视图获取人员列表
     * @return array|string
     * @throws \Exception
     */
    public function actionAjaxtreelist(){
        if(!$this->request->isPost){
            return $this->error('请求类型错误');
        }
        $post = $this->request->post();

        //使用in查询
        $params = $this->listStructParse($post);
        $query = (new Query())->from(Admin::tableName());

        //使用视图查询
//        $result = $this->viewQuery($post);
//        if($result) {
//            $params = $result;
//            $query = (new Query())->from(AdminView::tableName());
//        }else{
//            $query = (new Query())->from(Admin::tableName());
//        }

        $params['where']['status'] = 1;
        $params['field'] = 'id,realname,status,create_time';
        $query = $this->indexWhere($query, $params);

        $root_id = intval($this->app->params['root_admin_id']);
        $query = $query->andWhere(['<>','id',$root_id]);

        $pageSize = intval($post['pageSize'] ?? 10);
        $pageNum = intval($post['pageNum'] ?? 1);
        $pageNum = $pageNum < 1 ? 1 : $pageNum;
        $offset = ($pageNum - 1) * $pageSize;
        $count = $query->count();
        $query = $query->offset($offset)->limit($pageSize);
        $list = $query->all();
        $list = $this->indexAfter($list);
        return $this->success('操作成功',$list, ['total' => $count]);
    }
    /**
     * 首页渲染
     * @return string
     */
    protected function indexRender(): string
    {
        $root_id = intval($this->app->params['root_admin_id']);
        $roleList = (new RoleService())->getList();
        return $this->render('', ['root_id' => $root_id,'roleList'=>$roleList]);
    }

    /**
     * 首页列表查询前条件处理
     * @param array $params
     * @return array
     */
    protected function indexBefore(array $params): array
    {
        //使用in 进行组织和角色处理
        $params = $this->listStructParse($params);

        //使用视图查询
//        $result = $this->viewQuery($params);
//        if($result) {
//            $params = $result;
//            $this->model = AdminView::class;
//        }

        return $params;
    }

    /**
     * 使用视图方式查询，先通过下面sql创建b5net_admin_view视图
     * CREATE VIEW b5net_admin_view as ( SELECT a.*, d.struct_id_tree,d.struct_id,GROUP_CONCAT(r.role_id) as role_id FROM b5net_admin a  LEFT JOIN b5net_admin_role r ON a.id = r.admin_id LEFT JOIN ( select b.admin_id,GROUP_CONCAT( CONCAT(c.levels,',',c.id)) as struct_id_tree,GROUP_CONCAT(c.id) as struct_id from b5net_admin_struct b INNER JOIN b5net_struct c ON c.id = b.struct_id GROUP BY b.admin_id) d ON a.id = d.admin_id GROUP BY a.id)
     * 当会员大于1000时，使用原来的in 方法会sql过长
     * @param $params
     * @return array | false
     */
    protected function viewQuery(array $params){
        $role_id = $params['role_id'] ?? '';
        $struct_id = $params['structId'] ?? '';
        $contains = $params['contains']??0;
        if($struct_id == $this->app->params['root_struct_id']) $struct_id = 0;
        if($struct_id || $role_id){
            if ($role_id){
                $params['findinset']['role_id']=$role_id;
            }
            if($struct_id){
                if($contains){
                    $params['findinset']['struct_id_tree']=$struct_id;
                }else{
                    $params['findinset']['struct_id']=$struct_id;
                }
            }
            return $params;
        }
        return  false;
    }
    /**
     * 列表查询时，组织架构和角色查询处理
     * 查询出所有属于该组织或角色的用于ID，使用in查询
     * 用户超过1000会超出mysql的长度限制
     * @param $params
     * @return array|false
     */
    protected function listStructParse($params){
        $userIdList = [];
        //角色处理
        $role_id = $params['role_id'] ?? '';
        if($role_id){
            $roleUserList = (new AdminRoleService())->getAdminIdByRoleId($role_id);
            if(!$roleUserList){
                $params['where']['id'] = 0;
                return $params;
            }
            $userIdList = $roleUserList;
        }

        //组织架构处理
        $structUserIdList = [];
        $contains = $params['contains']??0;
        $root_struct_id = intval($this->app->params['root_struct_id']);
        $struct_id = $params['structId'] ?? '';
        if ($struct_id) {
            $structList = [];
            if($contains){
                if($root_struct_id != $struct_id){
                    //获取所有子组织
                    $structList = StructService::getChildList($struct_id,true);
                    $structList[] = $struct_id;
                }
            }else{
                $structList[] = $struct_id;
            }
            if($structList){
                //获取组织下的用户
                $list = (new AdminStructService())->getAdminIdByStructId($structList);
                $structUserIdList = $list?:false;
            }
        }

        if($structUserIdList === false){
            $params['where']['id'] = 0;
            $userIdList = [];
        }elseif($structUserIdList){
            $userIdList = array_merge($userIdList,$structUserIdList);
        }

        if($userIdList){
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
        $structService = new AdminStructService();
        $roleService = new AdminRoleService();
        $posService = new AdminPosService();
        foreach ($list as $key => $value) {
            $structInfo = $structService->getStructByAdminId($value['id'], true);

            $struct_name = '';
            if($structInfo){
                $structInfo = $structInfo[0];
                $struct_name = $structInfo['name'];
                if($structInfo['parent_name']){
                    $parent_name = explode(',',$structInfo['parent_name']);
                    $parent_name = array_pop($parent_name);
                    $struct_name = $parent_name.'/'.$struct_name;
                }
            }
            $value['struct_name'] = $struct_name;


            $roleList = $roleService->getRoleByAdmin($value['id'], true);
            $roleList = $roleList ? array_column($roleList, 'name') : [];
            $value['role_name'] = implode(',', $roleList);

            $posInfo = $posService->getPosByAdmin($value['id'],true);
            $value['pos_name'] = $posInfo?$posInfo['name']:'';
            $value['pos_key'] = $posInfo?$posInfo['poskey']:'';

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
        $roleList = (new RoleService())->getList();
        $posList = PositionCache::lists();
        return $this->render('', ['roleList' => $roleList,'posList'=>$posList]);
    }

    /**
     * 编辑页渲染
     * @param array $info
     * @return string
     */
    protected function editRender(array $info): string
    {
        $structInfo = (new AdminStructService())->getStructByAdminId($info['id'], true);

        $struct_id = implode(',',array_column($structInfo,'id'));
        $struct_name = implode(',',array_column($structInfo,'name'));

        $roleId = (new AdminRoleService())->getRoleByAdmin($info['id']);
        $roleList = (new RoleService())->getList();

        $posList = PositionCache::lists();
        $posId = (new AdminPosService())->getPosByAdmin($info['id']);
        return $this->render('', ['info'=>$info,'roleList' => $roleList,'struct_id'=>$struct_id,'struct_name'=>$struct_name,'roleId'=>$roleId,'posList'=>$posList,'posId'=>$posId]);
    }

    /**
     * 验证前进行数据处理
     * @param $model
     * @param string $type
     * @return string
     */
    protected function validateBefore($model, string $type): string
    {
        if (isset($model['password']) && !$model['password']) {
            if ($type == 'add') {
                $model['password'] = '123456';
            } else if ($type == 'edit') {
                unset($model['password']);
            }
            if(isset($model['realname']) && !$model['realname']){
                $model['realname'] = $model['username'];
            }
        }
        return '';
    }

    /**
     * 添加和编辑保存前对数据进行处理
     * @param \yii\db\ActiveRecord $model
     * @param string $type
     * @return string
     */
    protected function saveBefore(\yii\db\ActiveRecord $model, string $type): string
    {
        if($type == 'add' || $type == 'edit'){

            if(isset($model['password'])){
                if(!$model['password']){
                    $model['password'] = $model['oldAttributes']['password'];
                }else{
                    $model['password'] = md5($model['password']);
                }
            }
        }
        return '';
    }

    /**
     * 添加和编辑后更新角色和组织信息
     * @param \yii\db\ActiveRecord $model
     * @param string $type
     */
    protected function saveAfter(\yii\db\ActiveRecord $model, string $type): void
    {
        if ($type == 'add' || $type == 'edit') {
            $roles = $this->request->post('roles', '');
            $struct = $this->request->post('struct', '');
            $pos = $this->request->post('pos', '');

            (new AdminRoleService())->update($model['id'], $roles);
            (new AdminStructService())->update($model['id'], $struct);
            (new AdminPosService())->update($model['id'], $pos);
        }
    }

    /**
     * 删除前判断
     * @param array $data
     * @return string
     */
    protected function deleteBefore(array $data): string
    {
        $root_id = intval($this->app->params['root_admin_id']);
        if ($data['id'] == $root_id) {
            return '默认超级管理员无法删除';
        }
        return '';
    }

    /**
     * 删除后操作
     * @param array $data
     */
    protected function deleteAfter(array $data): void
    {
        //删除管理员角色
        (new AdminRoleService())->deleteByAdmin($data['id']);

        //删除管理员组织部门
        (new AdminStructService())->deleteByAdmin($data['id']);

        //删除管理员岗位
        (new AdminPosService())->deleteByAdmin($data['id']);
    }
}
