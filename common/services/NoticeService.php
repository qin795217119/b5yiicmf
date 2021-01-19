<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;


use common\models\Notice;

/**
 * 通知公告
 * Class NoticeService
 * @package App\Services
 */
class NoticeService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->model = new Notice();
        $this->validate =$loadValidate;
    }
}
