<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;

use common\models\AdminStruct;
use common\models\Struct;
use yii\helpers\ArrayHelper;

/**
 * 人员组织机构管理
 * Class AdminStructService
 * @package App\Services
 */
class AdminStructService{
    /**
     * 更新信息
     * @param $adminId
     * @param string $structId
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function update($adminId, $structId=''){
        if(empty($adminId)) return false;
        AdminStruct::deleteAll(['admin_id'=>$adminId]);
        if($structId){
            $structArr=explode(',',$structId);
            $structArr=array_unique($structArr);
            $fieldArr=['admin_id','struct_id'];
            $data=[];
            foreach ($structArr as $id){
                $data[]=[$adminId,$id];
            }
            (new AdminStruct())->insertAll($fieldArr,$data);
        }
        return true;
    }

    /**
     * 获取某个人员的组织列表
     * @param $adminId
     * @return array
     */
    public static function getListByAdmin($adminId){
        $reArr=[];
        if($adminId){
            $list=AdminStruct::find()->where(['admin_id' => $adminId])->asArray()->all();
            if($list){
                foreach ($list as $value){
                    $structInfo=Struct::findOne($value['struct_id']);
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
    public static function getUsersByStruct($structId){
        $list=[];
        if($structId){
            $structArr = StructService::getChildList($structId,true);
            $structArr[]= $structId;
            $list=AdminStruct::find()->where(['struct_id' => $structArr])->asArray()->all();
            $list = ArrayHelper::getColumn($list,'admin_id');
        }
        return $list?array_unique($list):[];
    }
}
