<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services\web;

use common\models\web\WebListExt;
use common\services\BaseService;

/**
 * 网站信息其他
 * Class WebCatService
 * @package App\Services
 */
class WebListExtService extends BaseService
{
    public function __construct(bool $loadValidate = true,bool $loadModel=true)
    {
        $loadModel && $this->model = new WebListExt();
        $this->validate = $loadValidate;
    }

    public function beforeAddFromList($data){
        if($data && isset($data['id'])){
            $delres=$this->model->drop($data['id']);
            if($delres!==false){
                $fieldArr=$this->model->getAttributes();
                if($fieldArr){
                    $opData=[];
                    foreach ($fieldArr as $field=>$deval){
                        $opData[$field]=$data[$field]??$deval;
                    }
                    return $this->add($opData);
                }
            }
        }
    }

}
