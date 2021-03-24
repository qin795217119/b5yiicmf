<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\models;

use common\helpers\Captcha\Captcha;
use common\helpers\commonApi;
use common\services\AdminRoleService;
use common\services\AdminStructService;
use common\services\LoginlogService;
use common\services\RoleMenuService;
use Yii;
use yii\base\Model;

/**
 * 管理登录模型
 * Class LoginForm
 * @package backend\models
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    private $_user;
    public $verifycode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'verifycode'], 'required'],
            ['verifycode', 'validateCode'],
            ['password', 'validatePassword'],
            ['rememberMe', 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
            'verifycode' => '验证码'
        ];
    }

    /**
     * 验证码雅正
     * @param $attribute
     * @param $params
     */
    public function validateCode($attribute, $params)
    {

        if (!$this->hasErrors()) {
            $b5captcha = new Captcha();

            if (!$b5captcha->check($this->verifycode)) {
                $this->addError($attribute, '验证码不正确');
            }
        }
    }

    /**
     * 验证密码和用户名
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, '用户名或密码不正确');
            } else {
                if (!$user->validatePassword($this->password)) {
                    $this->addError($attribute, '用户名或密码不正确');
                } elseif ($user->status != 1) {
                    $this->addError($attribute, '该用户已被禁用.');
                }
            }
        }
    }

    /**
     * 登录操作
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            $model = $this->getUser();
            $isLogin = Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            if ($isLogin) {
                $model->last_time = date('Y-m-d H:i:s', time());
                $model->last_ip = Yii::$app->getRequest()->getUserIP();
                $model->save(false);

                $userInfo = $model->toArray();
                $this->loginMySession($userInfo);
            }
            return $isLogin;
        } else {
            return false;
        }
    }

    /**
     * 登陆后处理自己的逻辑
     * @param $userInfo
     * @return bool
     */
    public function loginMySession($userInfo){
        if(!$userInfo) return false;
        //获取管理员组织
        $structList = (new AdminStructService())->getListByAdmin($userInfo['id']);

        //获取管理员分组
        $roleList = (new AdminRoleService())->getListByAdmin($userInfo['id'], false, false);
        $roleName = [];
        $roleId = [];
        foreach ($roleList as $role) {
            $roleId[] = $role['id'];
            $roleName[] = $role['name'];
        }
        //获取分组菜单权限ID
        $menuIdList = (new RoleMenuService())->getRoleMenuList($roleId);
        $sessionData = [
            'info' => [
                'id' => $userInfo['id'],
                'username' => $userInfo['username'],
                'name' => $userInfo['realname']
            ],
            'struct' => $structList,
            'role' => [
                'id' => $roleId,
                'name' => $roleName,
            ],
            'menu' => $menuIdList
        ];
        Yii::$app->session->destroy();
        Yii::$app->session->set(Yii::$app->params['adminLoginSession'], $sessionData);
        return true;
    }

    /**
     * 返回登录信息 并添加登录记录
     * @param $username
     * @param $msg
     * @param $success
     * @return array
     */
    public function loginResult($msg, $success)
    {
        (new LoginlogService())->logAdd($this->username ?: '', $success ? 1 : 0, $msg);
        return commonApi::message($msg, $success);
    }

    /**
     * 获取用户信息
     * @return mixed
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Admin::findByUsername($this->username);
        }
        return $this->_user;
    }
}
