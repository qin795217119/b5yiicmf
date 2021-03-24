<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace pc\controllers;

use common\cache\ConfigCache;
use common\cache\WebcatCache;
use common\models\web\WebList;
use common\services\web\WebAdService;
use common\services\web\WebListExtService;
use common\services\web\WebListService;
use common\widgets\B5LinkPager;
use yii\data\Pagination;
use yii\helpers\Url;
use Yii;

class SiteController extends BaseController
{
    public $view_group = 'default';
    public $layout = 'site/default/layout';

   public function beforeAction($action)
   {
       if(parent::beforeAction($action)){
           if(IS_GET && !IS_AJAX){
               \Yii::$app->view->params['menuList']=$this->getMenuList();
               \Yii::$app->view->params['web_site_name']=ConfigCache::get('web_site_name');
           }
           return true;
       }
       return false;
   }

    public function actionIndex()
    {
        $bannerList=(new WebAdService())->getListByPosId(1,5);
        return $this->render('',['activeMenu'=>'home','bannerList'=>$bannerList?:[]]);
    }

    /**
     * 新闻资讯和商品列表
     */
    public function actionList(){
        $id=intval(Yii::$app->request->get('id',0));
        if($id<1) return $this->toError();
        $catAllList=WebCatCache::get();
        $catInfo=$catAllList[$id]??[];

        if(!$catInfo || !in_array($catInfo['type'],['list','goods']) || !$catInfo['status']) return $this->toError();

        $catList=[];
        $parentCat=[];
        if($catInfo['parent_id']){
            $parentCat=$catAllList[$catInfo['parent_id']]??[];
            foreach ($catAllList as $val){
                if($val['parent_id']==$catInfo['parent_id']){
                    $val=$this->getMenuUrl($val);
                    $catList[]=$val;
                }
            }
        }else{
            $catList[]=$catInfo;
        }
        $temp=$catInfo['template_list']?:$catInfo['type'];
        $where=['catid'=>$id,'status'=>1];
        $count=WebList::find()->where($where)->count();

        $pagination=new Pagination(['totalCount'=>$count,'PageSize'=>2]);

        $list=(new WebList())->getList($where,['id','title','thumbimg','subtime','remark','linkurl'],[$pagination->offset,$pagination->limit],'',[['subtime','desc'],['id','desc']]);

        if($list){
            foreach ($list as $key=>$value){
                $value['linkurl']=Url::toRoute(['info','id'=>$value['id']]);
                $list[$key]=$value;
            }
        }
        $data=[
            'list' => $list?:[],
            'catList' => $catList,
            'catInfo' => $this->getMenuUrl($catInfo),
            'parentCat' => $this->getMenuUrl($parentCat),
            'activeMenu' => $catInfo['checkcode'],
            '_page' => B5LinkPager::widget(['pagination'=>$pagination])
        ];
        $temp=$this->view_group.'/'.$temp;
        return $this->render($temp,$data);
    }

    /**
     * 详情
     * @return string
     */
    public function actionInfo(){
        $id=intval(Yii::$app->request->get('id',0));
        if($id<1) return $this->toError();
        $info=(new WebListService())->info([['id','=',$id],['status','=',1]]);
        if(!$info) return $this->toError();
        if(!$info['catid']) $this->toError();
        $catInfo=WebCatCache::get($info['catid']);
        if(!$catInfo || !in_array($catInfo['type'],['list','goods']) || !$catInfo['status']) return $this->toError();
        $infoExt=(new WebListExtService())->info($info['id']);
        $infoExt=$infoExt?:[];
        if($infoExt && isset($infoExt['imglist']) && $infoExt['imglist']){
            $infoExt['imglist']=explode(',',$infoExt['imglist']);
        }
        $temp=$catInfo['template_info']?:$catInfo['type'].'_info';
        $temp=$this->view_group.'/'.$temp;
        return $this->render($temp,['catInfo'=>$catInfo,'activeMenu'=>$catInfo['checkcode'],'info'=>$info,'infoExt'=>$infoExt]);
    }
    /**
     * 单页处理
     */
    public function actionPage(){
        $id=intval(Yii::$app->request->get('id',0));
        if($id<1) return $this->toError();
        $catInfo=WebcatCache::get($id);
        if(!$catInfo || $catInfo['type']!='page' || !$catInfo['status']) return $this->toError();
        $temp=$catInfo['template_list']?:$catInfo['type'];
        $info=(new WebListService())->info([['catid'=>$id],['status'=>1]]);
        if(!$info) return $this->toError();
        $infoExt=(new WebListExtService())->info($info['id']);
        $temp=$this->view_group.'/'.$temp;
        return $this->render($temp,['catInfo'=>$catInfo,'info'=>$info,'infoExt'=>$infoExt,'activeMenu'=>$catInfo['checkcode']]);
    }

    /**
     * 获取菜单列表
     * @return array
     */
    private function getMenuList(){
        $list=WebcatCache::get();
        $reList=[];
        if($list){
            foreach ($list as $val){
                if(!$val['status']) continue;
                if($val['parent_id']==0){
                    $val['childArr']=[];
                    $val=$this->getMenuUrl($val);
                    $reList[$val['id']]=$val;
                }else{
                    if(isset($reList[$val['parent_id']])){
                        $val=$this->getMenuUrl($val);
                        $reList[$val['parent_id']]['childArr'][]=$val;
                    }
                }
            }
            unset($list);
        }
        return $reList;
    }
    /**
     * 获取菜单的链接
     * @param $menu
     * @return mixed
     */
    private function getMenuUrl($menu){
        if($menu && isset($menu['type'])){
            if($menu['type']=='none'){
                $menu['url']='';
            }elseif ($menu['type']=='page'){
                $menu['url']=Url::toRoute(['page','id'=>$menu['id']]);
            }elseif ($menu['type']=='list' || $menu['type']=='goods'){
                $menu['url']=Url::toRoute(['list','id'=>$menu['id']]);
            }
        }
        return $menu;
    }
}