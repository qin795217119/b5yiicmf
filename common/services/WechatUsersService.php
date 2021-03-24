<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;

use common\models\WechatUsers;

/**
 * 微信用户信息
 * Class WechatUsersService
 * @package App\Services
 */
class WechatUsersService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->model = new  WechatUsers();
        $this->validate = $loadValidate;
    }


}
