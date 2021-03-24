<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;

use common\models\AdminStruct;

/**
 * 人员组织机构管理
 * Class AdminStructService
 * @package App\Services
 */
class AdminStructService extends BaseService
{
    public function __construct(bool $loadValidate = true)
    {
        $this->model = new AdminStruct();
        $this->validate = $loadValidate;
    }

    /**
     * 更新信息
     * @param $adminId
     * @param $structId
     * @return bool
     */
    public function update($adminId, $structId=''){
        if(empty($adminId)) return false;

        $this->model->drop($adminId,'admin_id');
        if($structId){
            $structArr=explode(',',$structId);
            $structArr=array_unique($structArr);
            $fieldArr=['admin_id','struct_id'];
            $data=[];
            foreach ($structArr as $id){
                $data[]=[$adminId,$id];
            }
            $this->insertAll($fieldArr,$data);
        }
        return true;
    }

    /**
     * 获取某个人员的组织列表
     * @param $adminId
     * @return array
     */
    public function getListByAdmin($adminId){
        $reArr=[];
        if($adminId){
            $list=$this->getAll([['admin_id' => $adminId]]);

            if($list){
                $structService=new StructService();
                foreach ($list as $value){
                    $structInfo=$structService->info($value['struct_id'],true);
                    if($structInfo){
                        $reArr[]=[
                            'id'=>$structInfo['id'],
                            'name'=>$structInfo['name']
                        ];
                    }
                }
            }
        }
        return $reArr;
    }

    /**
     * 获取某个组织下的用户
     * @param $structId
     * @return array
     */
    public function getUsersByStruct($structId){
        $list=[];
        if($structId){
            $StructService=new StructService();
            $structInfo=$StructService->info($structId,true);
            if($structInfo){
                $chlist=$StructService->getChildList($structId,true);
                $chlist=$chlist?:[];
                $chlist[]=$structId;
                $list=$this->getAll([['struct_id' => $chlist]],['admin_id'],[],'admin_id,admin_id');
            }
        }

        return $list?array_unique($list):[];
    }
}
