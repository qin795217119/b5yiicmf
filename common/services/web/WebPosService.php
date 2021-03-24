<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services\web;

use common\models\web\WebPos;
use common\services\BaseService;

/**
 * 网站推荐位置
 * Class WebPosService
 * @package App\Services
 */
class WebPosService extends BaseService
{
    public function __construct(bool $loadValidate = true,bool $loadModel=true)
    {
        $loadModel && $this->model = new WebPos();
        $this->validate = $loadValidate;
    }
}
