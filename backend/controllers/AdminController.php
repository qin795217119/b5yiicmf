<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\helpers\commonApi;
use common\models\Admin;
use common\models\Role;
use common\services\AdminRoleService;
use common\services\AdminStructService;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * 人员管理控制器
 * Class AdminController
 * @package backend\controllers
 */
class AdminController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model = Admin::class;
    }

    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            $where = [];
            $structId = \Yii::$app->request->post('structId', 0);
            if ($structId > 0) {
                $userList = AdminStructService::getUsersByStruct($structId);
                if (!$userList) {
                    return commonApi::message('操作成功', true, [], 0, '', ['total' => 0]);
                } else {
                    $where = [['id' => $userList]];
                }
            }

            $return = parent::actionIndex(true, $where);
            $list = $return['data'];
            foreach ($list as $key => $val) {
                $structNameStr = '';
                $roleNameStr = '';
                $structList = AdminStructService::getListByAdmin($val['id']);
                $roleList = AdminRoleService::getListByAdmin($val['id']);
                if ($structList) {
                    $structNameArr = ArrayHelper::getColumn($structList, 'name');
                    $structNameStr = implode(',', $structNameArr);
                }
                if ($roleList) {
                    $roleNameArr = ArrayHelper::getColumn($roleList, 'name');
                    $roleNameStr = implode(',', $roleNameArr);
                }
                $val['rolename'] = $roleNameStr;
                $val['structname'] = $structNameStr;
                $list[$key] = $val;
            }
            $return['data'] = $list;
            return $return;
        } else {
            return parent::actionIndex();
        }
    }

    public function actionAdd()
    {
        if (IS_RENDER) {
            Yii::$app->view->params['roleList'] = Role::find()->asArray()->all();
            return parent::actionAdd();
        } else {
            $post = Yii::$app->request->post();
            $model = new Admin();
            if ($model->load($post, '') && $model->validate()) {
                if (!$model->realname) $model->realname = $model->username;
                if (!$model->password) {
                    $model->password = '123456';
                }
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
                if ($model->save(false)) {
                    $roles = $post['roles'] ?: '';
                    $struct = $post['struct'] ?: '';
                    AdminRoleService::update($model->id, $roles);
                    AdminStructService::update($model->id, $struct);
                    return commonApi::message('添加成功', true);
                }
            }
            return commonApi::message(commonApi::getModelError($model), false);
        }
    }

    public function actionEdit()
    {
        if (IS_RENDER) {
            $info = [];
            $id = intval(Yii::$app->request->get('id', 0));
            if ($id) {
                $info = Admin::findOne($id);
            }
            if (empty($info)) {
                return $this->tError('参数或信息错误');
            }
            $structs = $info->structs;
            $roles = $info->roles;
            $info = $info->toArray();

            $structid = [];
            $structname = [];
            foreach ($structs as $val) {
                $structid[] = $val['id'];
                $structname[] = $val['name'];
            }
            $info['structid'] = implode(',', $structid);
            $info['structname'] = implode(',', $structname);

            $roleid = [];
            foreach ($roles as $val) {
                $roleid[] = $val['id'];
            }
            $info['roleid'] = implode(',', $roleid);

            Yii::$app->view->params['roleList'] = Role::find()->asArray()->all();
            return $this->render('', ['info' => $info]);
        } else {
            $post = Yii::$app->request->post();
            if (!isset($post['id']) || !$post['id']) {
                return commonApi::message('参数错误', false);
            }
            $model = Admin::findOne($post['id']);
            if ($model->load($post, '') && $model->validate()) {
                if (!$model->realname) $model->realname = $model->username;
                if ($model->password) {
                    $model->password = Yii::$app->security->generatePasswordHash($model->password);
                } else {
                    $model->password = $model->oldAttributes['password'];
                }
                if ($model->save(false)) {
                    $roles = $post['roles'] ?: '';
                    $struct = $post['struct'] ?: '';
                    AdminRoleService::update($model->id, $roles);
                    AdminStructService::update($model->id, $struct);
                    return commonApi::message('添加成功', true);
                }
            }
            return commonApi::message(commonApi::getModelError($model), false);
        }
    }
}
