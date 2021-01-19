<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;

use common\cache\RedtypeCache;
use common\models\Redtype;
use common\helpers\commonApi;

/**
 * 跳转管理
 * Class RedtypeService
 * @package App\Services
 */
class RedtypeService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->model= new Redtype();
        $this->validate = $loadValidate;
    }

    /**
     * 获取模块列表
     * @param bool $valKey
     * @param bool $isable
     * @return array|mixed|string
     */
    public function getTypeList(bool $valKey = false,bool $isable=false)
    {
        $reArr=[];
        $list=$this->getAll([],['title','type','status','list_url','info_url'],[],'type');
        if($list){
            foreach ($list as $val){
                if($isable && !$val['status']) continue;
                if($valKey){
                    $reArr[$val['type']]=$val['title'];
                }else{
                    $reArr[$val['type']]=$val;
                }
            }
        }
        return $reArr;
    }
    /**
     * 清除缓存
     * @return array
     */
    public function delcache(){
        RedtypeCache::clear();
        return commonApi::message('清理缓存完成', true);
    }
}
