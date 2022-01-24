<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use backend\helpers\DataScopeAuth;
use common\helpers\commonApi;
use common\models\Role;
use common\models\Struct;
use common\services\RoleMenuService;
use common\services\RoleStructService;
use Yii;

/**
 * 角色管理控制器
 * Class RoleController
 * @package backend\controllers
 */
class RoleController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model = Role::class;
    }

    public function actionAuth(){
        if(IS_RENDER){
            $role_id=Yii::$app->request->get('role_id',0);
            if(!$role_id) return $this->tError('参数错误');
            $info=Role::findOne($role_id);
            if(empty($info)) return $this->tError('角色信息不存在');
            $menuList = RoleMenuService::getRoleMenuList($role_id);
            return $this->render("",['info'=>$info,'menuList'=>implode(',',$menuList)]);
        }else{
            $role_id=Yii::$app->request->post('id',0);
            if(!$role_id) return $this->tError('参数错误');
            $info=Role::findOne($role_id);
            if(empty($info)) return $this->tError('角色信息不存在');
            $treeId=Yii::$app->request->post('treeId','');
            RoleMenuService::update($role_id,$treeId);
            return commonApi::message();
        }
    }

    //角色数据权限
    public function actionDatascope()
    {
        if (IS_RENDER) {
            $role_id = Yii::$app->request->get('role_id', 0);
            if (!$role_id) return $this->tError('参数错误');
            $info = Role::findOne($role_id);
            if (empty($info)) return $this->tError('角色信息不存在');
            $dataList = DataScopeAuth::typeList();//数据范围列表
            $userStruct = RoleStructService::getRoleStructList($role_id);
            return $this->render("", ['info' => $info, 'dataList' => $dataList, 'userStruct' => implode(',', $userStruct)]);
        } else {
            $role_id = Yii::$app->request->post('id', 0);
            if (!$role_id) return $this->tError('参数错误');
            $info = Role::findOne($role_id);
            if (empty($info)) return $this->tError('角色信息不存在');
            $dataList = DataScopeAuth::typeList();//数据范围列表
            $data_scope = Yii::$app->request->post('data_scope','');
            if(!$data_scope || !array_key_exists($data_scope,$dataList)){
                if (empty($info)) return $this->tError('请选择数据范围');
            }
            $info->data_scope = $data_scope;
            $info->save(false);
            $treeId = Yii::$app->request->post('treeId', '');
            RoleStructService::update($role_id, $treeId);
            return commonApi::message();
        }
    }

    public function actionGetrolestructlist()
    {
        $roleId = Yii::$app->request->get('roleId', '');
        $list = Struct::find()->select(['id', 'parent_id', 'name'])->orderBy('parent_id asc,listsort asc')->asArray()->all();
        if ($roleId) {
            $hasList = RoleStructService::getRoleStructList($roleId);
        } else {
            $hasList = [];
        }
        $hasList = $hasList ?: [];
        foreach ($list as $key => $value) {
            $list[$key]['checked'] = in_array($value['id'],$hasList);
        }
        return commonApi::message('',true,$list);
    }
}
