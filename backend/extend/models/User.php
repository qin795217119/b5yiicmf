<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\extend\models;

use common\models\system\Admin;
use yii\web\IdentityInterface;

class User extends Admin implements IdentityInterface{

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => 1]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return false;
    }

    public function getId()
    {
        return $this->primaryKey;
    }

    public function getAuthKey()
    {
        return '';
    }

    public function validateAuthKey($authKey)
    {
        return true;
    }

    /**
     * 验证密码
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password):bool
    {
        return $this->password === md5($password);
    }

    public function setPassword($password)
    {
        $this->password = md5($password);
    }
}