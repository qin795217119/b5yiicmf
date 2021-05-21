<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;

use common\models\AdminRole;
use common\models\Role;
use yii\helpers\ArrayHelper;

/**
 * 人员权限分组管理
 * Class AdminRoleService
 * @package App\Services
 */
class AdminRoleService
{
    /**
     * 更新信息
     * @param $adminId
     * @param string $roleId
     * @return bool
     * @throws \yii\db\Exception
     */
    public static function update($adminId, $roleId=''){
        if(empty($adminId)) return false;
        AdminRole::deleteAll(['admin_id'=>$adminId]);
        if($roleId){
            $roleArr=explode(',',$roleId);
            $roleArr=array_unique($roleArr);
            $fieldArr=['admin_id','role_id'];
            $data=[];
            foreach ($roleArr as $id){
                $data[]=[$adminId,$id];
            }
            (new AdminRole())->insertAll($fieldArr,$data);
        }
        return true;
    }

    /**
     * 获取某个人员的角色列表
     * @param $adminId
     * @param bool $all
     * @param bool $onlyKey
     * @return array
     */
    public static function getListByAdmin($adminId,bool $all=true,bool $onlyKey=false){
        $reArr=[];
        if($adminId){
            $list=AdminRole::find()->where(['admin_id' => $adminId])->asArray()->all();
            if($list){
                foreach ($list as $value){
                    $roleInfo=Role::findOne($value['role_id']);
                    if($roleInfo){
                        if($all || (!$all && $roleInfo['status'])){
                            if($onlyKey){
                                $reArr[]=$roleInfo['id'];
                            }else{
                                $reArr[]=[
                                    'id'=>$roleInfo['id'],
                                    'name'=>$roleInfo['name']
                                ];
                            }
                        }
                    }
                }
            }
        }
        return $reArr;
    }

    /**
     * 获取某个角色下的所有用户
     * @param $roleId
     * @return array
     */
    public static function getUsersByRole($roleId){
        $list=[];
        if($roleId){
            $list=AdminRole::find()->where(['role_id' => $roleId])->asArray()->all();
            $list = ArrayHelper::getColumn($list,'admin_id');
        }
        return $list?array_unique($list):[];
    }
}
