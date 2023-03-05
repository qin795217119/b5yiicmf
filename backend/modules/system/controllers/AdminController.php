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
        $params = [];
        $post = $this->request->post();

        $userIdList = $this->listStructParse($post);
        if($userIdList === false){
            $params['where']['id'] = 0;
        }elseif($userIdList){
            $params['in']['id'] = implode(',', array_unique($userIdList));
        }
        $params['like']['realname'] = $post['like']['realname']??'';
        $params['where']['status'] = 1;
        $params['field'] = 'id,realname,status,create_time';

        $query = (new Query())->from($this->model::tableName());
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
        $userIdList = [];
        //角色处理
        $role_id = $params['role_id'] ?? '';
        if($role_id){
            $roleList = (new AdminRoleService())->getAdminIdByRoleId($role_id);
            if(!$roleList){
                $params['where']['id'] = 0;
                return $params;
            }
            $userIdList = $roleList;
        }

        //组织架构处理
        $structUserList = $this->listStructParse($params);
        if($structUserList === false){
            $params['where']['id'] = 0;
        }elseif($structUserList){
            $userIdList = array_merge($userIdList,$structUserList);
        }

        if($userIdList){
            $params['in']['id'] = array_unique($userIdList);
        }
        return $params;
    }
    /**
     * 列表查询时，组织架构处理
     * @param $post
     * @return array|false
     */
    protected function listStructParse($post){
        $userIdList = [];
        //组织架构处理
        $contains = $post['contains']??0;
        $root_struct_id = intval($this->app->params['root_struct_id']);
        $struct_id = $post['structId'] ?? '';
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
                $userIdList = $list?:false;
            }
        }
        return $userIdList;
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
     * @return bool
     */
    protected function validateBefore($model, string $type)
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
        return true;
    }

    /**
     * 添加和编辑保存前对数据进行处理
     * @param \yii\db\ActiveRecord $model
     * @param string $type
     * @return bool|string
     */
    protected function saveBefore(\yii\db\ActiveRecord $model, string $type)
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
        return true;
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
     * @return bool|string
     */
    protected function deleteBefore(array $data)
    {
        $root_id = intval($this->app->params['root_admin_id']);
        if ($data['id'] == $root_id) {
            return '默认超级管理员无法删除';
        }
        return true;
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
