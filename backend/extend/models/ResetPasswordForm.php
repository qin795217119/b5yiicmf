<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\extend\models;

use yii\base\Model;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $oldpass;
    public $newpass;
    public $confirmpass;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldpass', 'newpass', 'confirmpass'], 'required'],
            [['newpass','confirmpass'], 'string', 'max' => 20, 'min' => 6],
            ['confirmpass', 'compare', 'compareAttribute' => 'newpass','message'=>'新密码和确认密码不一致'],
            ['oldpass','validatePassword']
        ];
    }

    public function attributeLabels()
    {
        return [
            'oldpass' => '旧密码',
            'newpass' => '新密码',
            'confirmpass' => '确认密码'
        ];
    }


    /**
     * 验证密码
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, '登陆信息错误');
            } else {
                if (!$user->validatePassword($this->oldpass)) {
                    $this->addError($attribute, '旧密码不正确');
                }
            }
        }
    }
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        if($this->validate()){
            $user=$this->getUser();
            $user->setPassword($this->newpass);
            return $user->save(false);
        }else{
            return false;
        }
    }

    /**
     * 获取用户信息
     * @return mixed
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = \Yii::$app->user->identity;
        }
        return $this->_user;
    }
}
