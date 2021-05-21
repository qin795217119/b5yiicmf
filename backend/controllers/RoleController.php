<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\helpers\commonApi;
use common\models\Role;
use common\services\RoleMenuService;
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
}
