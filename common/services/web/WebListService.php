<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services\web;

use common\models\web\WebList;
use common\services\BaseService;

/**
 * 网站内容信息
 * Class WebPosService
 * @package App\Services
 */
class WebListService extends BaseService
{
    public function __construct(bool $loadValidate = true,bool $loadModel=true)
    {
        $loadModel && $this->model = new WebList();
        $this->validate = $loadValidate;
    }

    public function after_getList($list,$param)
    {
        if($list){
            foreach ($list as $key=>$value){
                $value['catid_name']=isset($catList[$value['catid']]['title'])?$catList[$value['catid']]['title']:'';
                $list[$key]=$value;
            }
        }

        return $list;
    }

    public function before_op($data, $type = '')
    {
        if($type=='add' || $type=='edit'){
            $data['thumbimg']=(isset($data['imglist']) && $data['imglist'])?(is_array($data['imglist'])?$data['imglist'][0]:$data['imglist']):'';
        }
        return parent::before_op($data, $type); // TODO: Change the autogenerated stub
    }

    public function after_add($data)
    {
        $this->extDataOp($data);
        return parent::after_add($data); // TODO: Change the autogenerated stub
    }

    public function after_edit($data)
    {
        $this->extDataOp($data);
        return parent::after_edit($data); // TODO: Change the autogenerated stub
    }

    private function extDataOp($data){
        if(isset($data['imglist']) && is_array($data['imglist'])){
            $data['imglist']=implode(',',$data['imglist']);
        }
        (new WebListExtService())->beforeAddFromList($data);
    }

    public function after_drop($data,$field)
    {
        (new WebListExtService())->drop($data,$field);
        return parent::after_drop($data,$field); // TODO: Change the autogenerated stub
    }
}