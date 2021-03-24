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

    /**
     * 根据广告位置ID获取获取
     * @param $pos_id
     * @param int $num
     * @return array
     */
    public function getListByPosId($pos_id,$num=0){
        if(!$pos_id) return [];
        if($num>0){
            $pageData=[0,$num];
        }else{
            $pageData=[];
        }
        $list=(new WebAdService())->getAll([['pos_id'=>$pos_id],['status'=>1]],['id','title','linkurl','imglist'],$pageData,'',[['listsort','asc'],['id','asc']]);
        if($list){
            foreach ($list as $key=>$value){
                if($value['imglist']){
                    $value['imglist']=explode(',',$value['imglist']);
                }else{
                    $value['imglist']=[];
                }
                $value['firstimg']=$value['imglist']?$value['imglist'][0]:'';
                $list[$key]=$value;
            }
        }
        return $list;
    }
}
