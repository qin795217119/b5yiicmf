<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\services\web\WebCatService;
use common\services\web\WebListExtService;
use common\services\web\WebListService;
use Yii;

class WeblistController extends BaseController
{
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->service=new WebListService();
        $this->view_group='/web/weblist';
    }

    public function actionIndex()
    {
        if(IS_POST){
            $catid=intval(Yii::$app->request->post('catid',0));
            $param=[];
            if($catid>0){
                $catIdArr=(new WebCatService())->getChildList($catid);
                $catIdArr=$catIdArr?:[];
                if($catIdArr){
                    $catIdArr[]=$catid;
                    $param[]=['catid','in',$catIdArr];
                }else{
                    $param[]=['catid','=',$catid];
                }
            }
            return $this->service->getList(true,$param);
        }
        return parent::actionIndex(); // TODO: Change the autogenerated stub
    }
    public function actionAdd()
    {
        if(IS_GET){
            $catId=intval(Yii::$app->request->get('catid',0));
            if($catId<1) return $this->toError('参数错误');
            $catInfo=(new WebCatService())->info($catId);
            if(!$catInfo) return $this->toError('菜单分类信息不存在');
            Yii::$app->view->params['catInfo']=$catInfo;
        }
        return parent::actionAdd(); // TODO: Change the autogenerated stub
    }
    public function edit_before($info, $data)
    {
        $catInfo=(new WebCatService())->info($info['catid']);
        Yii::$app->view->params['catInfo']=$catInfo?:[];

        $extInfo=(new WebListExtService())->info($info['id']);
        Yii::$app->view->params['extInfo']=$extInfo?:['imglist'=>'','content'=>''];
        return parent::edit_before($info, $data); // TODO: Change the autogenerated stub
    }
}