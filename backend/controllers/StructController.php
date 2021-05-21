<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\helpers\commonApi;
use common\models\Struct;
use common\services\StructService;
use Yii;

/**
 * 组织构架控制器
 * Class StructController
 * @package backend\controllers
 */
class StructController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model=Struct::class;
    }

    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            return parent::actionIndex(true);
        }
        return parent::actionIndex();
    }

    public function actionAdd()
    {
        if (IS_RENDER) {
            $parent_name = '顶级组织';
            $parent_id = intval(Yii::$app->request->get('id',0));
            if (empty($parent_id)) {
                $parent_id = StructService::getFirstId();
            }
            if($parent_id){
                $parentInfo = Struct::findOne($parent_id);
                if ($parentInfo) {
                    $parent_name = $parentInfo->parent_id?$parentInfo->fullname.'-'.$parentInfo->name:$parentInfo->name;
                }else{
                    $parent_id = 0;
                }
            }

            Yii::$app->view->params['parent_id']=$parent_id;
            Yii::$app->view->params['parent_name']=$parent_name;
            return $this->render();
        }else{
            $data = Yii::$app->request->post();
            if(!$data) return commonApi::message('无提交数据', false);

            $checkRes= $this->check_data($data,'add');
            if(!$checkRes['success']){
                return $checkRes;
            }
            $data = $checkRes['data'];

            $model = new Struct();
            if (!$model->load($data, '')) {
                return commonApi::message('无提交数据', false);
            }
            if (!$model->validate()) {
                return commonApi::message(commonApi::getModelError($model), false);
            }
            $result = $model->save(false);
            if ($result) {
                return commonApi::message('添加成功', true);
            } else {
                return commonApi::message( '添加失败', false);
            }
        }
    }

    /**
     * 编辑操作
     * @return array|string
     */
    public function actionEdit()
    {
        if (IS_RENDER) {
            $info = [];
            $id = intval(Yii::$app->request->get('id',0));
            if($id){
                $info = Struct::findOne($id);
            }
            if (empty($info)) {
                return $this->tError('参数或信息错误');
            }
            $info = $info->toArray();
            $parent_id = intval($info['parent_id']);
            if($parent_id<1){
                $info['fullname']='顶级组织';
            }
            return $this->render('', ['info' => $info]);
        }else{
            $data = Yii::$app->request->post();
            if (!$data) return commonApi::message('无提交数据', false);

            if (!isset($data['id']) || !$data['id']) {
                return commonApi::message('缺少主键参数', false);
            }
            $model = Struct::findOne($data['id']);
            if (!$model) {
                return commonApi::message('信息不存在', false);
            }

            $checkRes= $this->check_data($data,'add');
            if(!$checkRes['success']){
                return $checkRes;
            }
            $data = $checkRes['data'];

            if (!$model->load($data, '')) {
                return commonApi::message('无提交数据', false);
            }
            if (!$model->validate()) {
                return commonApi::message(commonApi::getModelError($model), false);
            }
            $result = $model->save(false);
            if ($result !== false) {
                return commonApi::message('保存成功', true);
            } else {
                return commonApi::message('保存失败', false);
            }
        }
    }
    //添加和修改保存时数据验证和levels赋值
    public function check_data($data,$type='add')
    {
        $levelsArr = [0];
        if($data['parent_id']){
            $parentInfo = Struct::findOne($data['parent_id']);
            if(!$parentInfo){
                return commonApi::message('上级组织信息错误',false);
            }
            $levelsArr = explode(',', $parentInfo['levels']);
            if ($type == 'edit'){
                if($data['id']==$data['parent_id'] || in_array($data['id'], $levelsArr)) {
                    return commonApi::message('上级组织不能是自己或自己的子组织',false);
                }
            }
            $data['fullname'] = $parentInfo->parent_id?$parentInfo->fullname.'-'.$parentInfo->name:$parentInfo->name;
            array_push($levelsArr, $data['parent_id']);
        }else{
            $data['fullname']="";
        }
        $levelsArr = array_unique($levelsArr);
        $data['levels'] = implode(',', $levelsArr);
        return  commonApi::message('',true,$data);
    }
    public function actionDrop()
    {
        $id = intval(Yii::$app->request->post('id',0));
        if($id<1){
            return commonApi::message('参数错误', false);
        }
        $info = Struct::findOne($id);
        if(!$info){
            return commonApi::message('信息不存在或已删除', false);
        }
        $hasChild = Struct::findOne(['parent_id' => $id]);
        if ($hasChild) {
            return commonApi::message('含有子组织无法删除', false);
        }
        $result = $info->delete();
        if ($result) {
            return commonApi::message('删除成功', true);
        }
        return commonApi::message('删除失败', false);
    }

    public function actionTree()
    {
        if (Yii::$app->request->isPost) {
            $list = Struct::find()->select(['id', 'parent_id', 'name'])->orderBy('parent_id asc,listsort asc')->asArray()->all();
            return commonApi::message('操作成功', true, $list);
        } else {
            $id =Yii::$app->request->get('id');
            $ismult = Yii::$app->request->get('ismult');
            if (empty($id) && empty($ismult)) {
                $id = StructService::getFirstId();
            }
            return $this->render('',['ismult'=>$ismult,'structId'=>$id]);
        }
    }
}
