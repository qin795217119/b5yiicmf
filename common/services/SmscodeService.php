<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;

use common\models\Smscode;

/**
 * 短信验证码
 * Class SmscodeService
 * @package App\Services
 */
class SmscodeService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->model = new Smscode();
        $this->validate = $loadValidate;
    }
}
