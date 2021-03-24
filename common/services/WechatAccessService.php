<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;

use common\models\WechatAccess;

/**
 * 微信公众号token和jsapi信息
 * Class WechatAccessService
 * @package App\Services
 */
class WechatAccessService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->model = new WechatAccess();
        $this->validate = $loadValidate;
    }


}
