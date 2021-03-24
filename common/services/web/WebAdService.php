<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services\web;

use common\models\web\WebAd;
use common\services\BaseService;

/**
 * 网站推荐信息
 * Class WebAdService
 * @package App\Services
 */
class WebAdService extends BaseService
{
    public function __construct(bool $loadValidate = true,bool $loadModel=true)
    {
        $loadModel && $this->model = new WebAd();
        $this->validate = $loadValidate;
    }
}
