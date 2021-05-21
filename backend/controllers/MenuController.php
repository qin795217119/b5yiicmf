<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\models\Menu;
use common\services\MenuService;
use Yii;

/**
 * 菜单控制器
 * Class MenuController
 * @package backend\controllers
 */
class MenuController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model = Menu::class;
    }

    public function actionIndex()
    {
        if(Yii::$app->request->isPost){
            return parent::actionIndex(false,[],[['parent_id','asc'],['listsort','asc'],['id','asc']]);
        }
        return parent::actionIndex();
    }

    public function actionAdd()
    {
        if(IS_RENDER){
            $parent_name='主目录';
            $parent_id=intval(Yii::$app->request->get('id',0));
            if($parent_id>0){
                $parentInfo=Menu::findOne($parent_id);
                if($parentInfo){
                    $parent_name=$parentInfo->name;
                }else{
                    $parent_id=0;
                }
            }
            Yii::$app->view->params['parent_id']=$parent_id;
            Yii::$app->view->params['parent_name']=$parent_name;
            Yii::$app->view->params['typeList']=MenuService::typeList();
        }
        return parent::actionAdd();
    }

    public function actionEdit()
    {
        if(IS_RENDER){
            $info = [];
            $id = intval(Yii::$app->request->get('id',0));
            if($id){
                $info = Menu::findOne($id);
            }
            if (empty($info)) {
                return $this->tError('参数或信息错误');
            }
            $info = $info->toArray();
            $parent_name='主目录';
            $parent_id = intval($info['parent_id']);
            if($parent_id>0){
                $parentInfo=Menu::findOne($parent_id);
                if($parentInfo){
                    $parent_name=$parentInfo->name;
                }else{
                    $parent_id=0;
                }
            }
            $info['parent_id']=$parent_id;
            $info['parent_name']=$parent_name;
            Yii::$app->view->params['typeList']=MenuService::typeList();
            return $this->render('', ['info' => $info]);
        }
        return parent::actionEdit();
    }

    public function actionTree(){
        if(Yii::$app->request->isPost){
            return MenuService::getTree();
        }else{
            $id = Yii::$app->request->get('id', 0);
            $root = Yii::$app->request->get('root', 1);
            return $this->render('',['menuId'=>$id,'root'=>$root]);
        }
    }
}
