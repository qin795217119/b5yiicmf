<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;


use common\models\AdminRole;
use common\helpers\commonApi;

/**
 * 人员权限分组管理
 * Class AdminRoleService
 * @package App\Services
 */
class AdminRoleService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->model = new  AdminRole();
        $this->validate = $loadValidate;
    }

    public function getList($isgroup=true)
    {
        $map = [];
        $sort = [];
        $order_column = 'id';
        $order_sort = 'asc';
        $page = 1;
        $limit = PAGE_LIMIT;

        $param = \Yii::$app->request->post();

        if(empty($param['role_id'])){
            return commonApi::message('操作成功', true, [], 0, '', ['total' => 0]);
        }

        //表单的条件 where 的条件
        if (!empty($param['where']) && is_array($param['where'])) {
            foreach ($param['where'] as $paramField => $paramValue) {
                $paramValue = trim($paramValue);
                if ($paramValue !== '') {
                    $map[] = [$paramField => $paramValue];
                }
            }
        }
        //表单的条件 like 的条件
        if (!empty($param['like']) && is_array($param['like'])) {
            foreach ($param['like'] as $paramField => $paramValue) {
                $paramValue = trim($paramValue);
                if ($paramValue !== '') {
                    $map[] = ['like', $paramField, $paramValue];
                }
            }
        }

        //排序条件
        if (!empty($param['orderByColumn'])) {
            $order_column = trim($param['orderByColumn']);
        }
        if (!empty($param['isAsc'])) {
            $order_sort = trim($param['isAsc']);
        }
        // 分页条件
        if (!empty($param['pageNum'])) $page = intval($param['pageNum']);
        if (!empty($param['pageSize'])) $limit = intval($param['pageSize']);

        $sort || $sort = [[$order_column, $order_sort]];
        $offset = ($page - 1) * $limit;

        $adminModel=(new AdminService())->model;
        $query=$adminModel->getQuery();
        $query=$query->where(1);
        if($map){
            $query=$adminModel->whereFormat($query,$map);
        }

        if($isgroup){
            $a=$adminModel::tableName();
            $b=$this->model::tableName();
            $query=$query->select("{$a}.*,{$b}.id as aid");
            $query=$query->leftJoin($b, "`{$a}`.`id` = `{$b}`.`admin_id`");
            $query=$query->andWhere(["role_id"=>$param['role_id']]);
        }else{
            $idList=$this->getUsersByRole($param['role_id']);
            if($idList){
                $query=$query->andWhere(['not in', 'id', $idList]);
            }
        }

        $count=$query->count();
        $query=$query->offset($offset)->limit($limit);

        if (!empty($sort)) {
            $orderBy=[];
            foreach ($sort as $sortkey=>$sortval){
                if(is_array($sortval)){
                    $orderBy[]=$sortval[0].' '.$sortval[1];
                }else{
                    $orderBy[]=$sortkey.' '.$sortval;
                }
            }
            $orderBy=implode(',',$orderBy);
            $query = $query->orderBy($orderBy);
        }
        $list = $query->asArray()->all();


        return commonApi::message('操作成功', true, $list, 0, '', ['total' => $count]);
    }


    /**
     * 更新信息
     * @param $adminId
     * @param $roleId
     * @return bool
     */
    public function update($adminId, $roleId=''){
        if(empty($adminId)) return false;

        $this->model->drop($adminId,'admin_id');
        if($roleId){
            $structArr=explode(',',$roleId);
            $structArr=array_unique($structArr);
            $fieldArr=['admin_id','role_id'];
            $data=[];
            foreach ($structArr as $id){
                $data[]=[$adminId,$id];
            }
            $this->insertAll($fieldArr,$data);
        }
        return true;
    }

    /**
     * 获取某个人员的角色列表
     * @param $adminId
     * @param bool $all
     * @param bool $onlyKey
     * @return array
     */
    public function getListByAdmin($adminId,bool $all=true,bool $onlyKey=false){
        $reArr=[];
        if($adminId){
            $list=$this->getAll([['admin_id' => $adminId]]);
            if($list){
                $RoleService=new RoleService();
                foreach ($list as $value){
                    $roleInfo=$RoleService->info($value['role_id'],true);
                    if($roleInfo){
                        if($all || (!$all && $roleInfo['status'])){
                            if($onlyKey){
                                $reArr[]=$roleInfo['id'];
                            }else{
                                $reArr[]=[
                                    'id'=>$roleInfo['id'],
                                    'name'=>$roleInfo['name']
                                ];
                            }

                        }
                    }
                }
            }
        }
        return $reArr;
    }

    /**
     * 获取某个角色下的所有用户
     * @param $roleId
     * @return array
     */
    public function getUsersByRole($roleId){
        $list=[];
        if($roleId){
            $RoleService=new RoleService();
            $roleInfo=$RoleService->info($roleId,true);
            if($roleInfo){
                $list=$this->getAll([['role_id' => $roleId]],['admin_id'],[],'admin_id,admin_id');
            }
        }
        return $list?array_unique($list):[];
    }
}
