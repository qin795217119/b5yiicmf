<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\extend\models;

use common\services\system\AdminRoleService;
use common\services\system\AdminStructService;
use common\services\system\RoleMenuService;
use Yii;
use yii\base\Model;


class LoginForm extends Model
{
    public $username;
    public $password;
    public $captcha;
    public $remember;

    private $_user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password','captcha'], 'required'],
            ['captcha', 'captcha','captchaAction' => 'public/captcha'],
            ['password', 'validatePassword'],
            ['remember', 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'captcha' => '验证码'
        ];
    }


    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码错误');
            }
        }
    }

    /**
     * 用户登录
     * @return bool
     */
    public function login():bool
    {
        if ($this->validate()) {
            $user = $this->getUser();
            if(!$user) {
                $this->addError('username', '用户名或密码错误');
                return false;
            }
            $isLogin =  Yii::$app->user->login($user, $this->remember ? 3600 * 24 * 30 : 0);
            if(!$isLogin){
                $this->addError('username', '登录失败');
                return false;
            }
            return $this->loginSession($user['id']);
        }
        return false;
    }

    /**
     * 保存登录信息
     * @param $id
     * @return bool
     */
    public function loginSession($id): bool
    {
        $user = $this->getUser($id);
        if (!$user) {
            $this->addError('username', '用户名或密码错误');
            return false;
        }

        if ($user['status'] != 1) {
            $this->addError('username', '用户已被禁用，无法登录');
            return false;
        }

        $dataScope = 0; //数据权限
        $roleId = [];//角色ID数组
        $is_admin = 0;//超级管理员
        $menuList = []; //权限列表
        $struct = AdminStructService::getStructByAdminId($user['id'],true);//组织部门

        $root_admin_id = intval(Yii::$app->params['root_admin_id']);
        if($user['id'] == $root_admin_id){
            $is_admin = 1;
        }
        //非超管时，获取角色
        if(!$is_admin){
            $roleList= AdminRoleService::getRoleByAdmin($user['id'],true);
            foreach ($roleList as $role){
                if(!$role['status']) continue;
                $dataScope += $role['data_scope'];
                $roleId[] = $role['id'];
            }
        }

        //非超管获取菜单列表
        if(!$is_admin){
            $menuList = RoleMenuService::getRoleMenuList($roleId);
        }

        //非超管且无角色 无法登录
        if(!$is_admin && !$roleId){
            $this->addError('username', '无角色分组，登录失败');
            return false;
        }

        $sessionData = [
            'info' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'name' => $user['realname'],
                'is_admin' => $is_admin
            ],
            'dataScope' => $is_admin?0:$dataScope,
            'struct' => $struct,
            'role' => $is_admin?[]:$roleId,
            'menu' => $is_admin?[]:$menuList,
        ];
        Yii::$app->session->set('adminLoginInfo', $sessionData);
        return true;
    }

    /**
     * @param $id
     * @return User|null
     */
    protected function getUser($id=null)
    {
        if ($this->_user === null) {
            if(!$id){
                $this->_user = User::findOne(['username'=>$this->username]);
            }else{
                $this->_user = User::findOne($id);
            }

        }
        return $this->_user;
    }
}
