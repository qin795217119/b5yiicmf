<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services\scratch;

use common\models\scratch\ScratchPrizeUsers;
use common\services\BaseService;

/**
 * 刮奖中奖会员
 * Class ScratchPrizeUsersService
 * @package App\Services
 */
class ScratchPrizeUsersService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->model = new ScratchPrizeUsers();
        $this->validate = $loadValidate;
    }

}
