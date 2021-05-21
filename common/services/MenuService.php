<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\services;


use backend\helpers\commonBack;
use common\models\Menu;
use common\helpers\commonApi;
use Yii;
use yii\helpers\Url;

/**
 * 菜单管理
 * Class MenuService
 * @package App\Services
 */
class MenuService
{
    /**
     * 菜单类型
     * @return array
     */
    public static function typeList()
    {
        return ['M' => '目录', 'C' => '菜单', 'F' => '按钮'];
    }


    /**
     * 选择父级菜单的菜单树数据
     * @return array
     */
    public static function getTree()
    {
        $list = Menu::find()->select(['id', 'parent_id', 'name'])->orderBy('parent_id asc,listsort asc,id asc')->asArray()->all();
        $root = Yii::$app->request->get('root',1);
        if ($root) {
            $first = [
                'id' => 0,
                'parent_id' => -1,
                'name' => '主目录'
            ];
            if ($list) {
                array_unshift($list, $first);
            }
        }
        return commonApi::message('操作成功', true, $list);
    }

    /**
     * 根据登录session获取菜单
     * @return string
     * @throws \Exception
     */
    public static function getMenuListByLogin(){
        $menuHtml='';
        $menuList=[];
        $adminId=commonBack::adminLoginInfo('info.id');
        if($adminId){
            if($adminId==1){
                $menuList = Menu::find()->select(['id', 'type', 'name', 'url', 'parent_id', 'icon', 'is_refresh','target'])->where(['<>','type', 'F'])->andWhere(['status'=>1])->orderBy(['parent_id'=>SORT_ASC,'listsort'=>SORT_ASC,'id'=>SORT_ASC])->asArray()->all();

            }else {
                $menuIdList =commonBack::adminLoginInfo('menu');
                if ($menuIdList) {
                    //获取菜单
                    $menuList = Menu::find()->select(['id', 'type', 'name', 'url', 'parent_id', 'icon', 'is_refresh','target'])->where(['id'=>$menuIdList])->andWhere(['<>', 'type', 'F'])->andWhere(['status' => 1])->orderBy(['parent_id'=>SORT_ASC,'listsort'=>SORT_ASC,'id'=>SORT_ASC])->asArray()->all();
                }
            }
        }
        if($menuList){
            $menuTree=self::getMenuTree($menuList);
            if($menuTree){
                $menuHtml=self::menuToHtml($menuTree);
            }
        }
        return $menuHtml;
    }
    /**
     * 将菜单转为数形无限极
     * @param $list
     * @param int $pid
     * @param int $deep
     * @return array
     */
    public static function getMenuTree($list, $pid = 0, $deep = 0)
    {
        $tree = [];
        foreach ($list as $key => $row) {
            if ($row['parent_id'] == $pid) {
                $row['deep'] = $deep;
                unset($list[$key]);
                $row['child'] = self::getMenuTree($list, $row['id'], $deep + 1);
                $tree[] = $row;
            }
        }
        return $tree;
    }
    /**
     * 将菜单树形转为html
     * @param $menus
     * @param int $deep
     * @return string
     */
    public static function menuToHtml($menus,$deep=0)
    {
        $html = '';
        if (is_array($menus)) {
            foreach ($menus as $t) {
                if($t['parent_id']==$deep){
                    if ($t['type'] == 'C') {
                        if($t['parent_id']==0){
                            $html .= '<li><a class="'.($t['target']=='1'?'menuBlank':'menuItem').'" href="'.self::formateUrl($t['url']).'" data-refresh="'.($t['is_refresh']?'true':'false').'">'.($t['icon']?'<i class="'.$t['icon'].'"></i>':'').' <span class="nav-label">'.$t['name'].'</span></a></li>';
                        }else{
                            $html .= '<li><a class="'.($t['target']=='1'?'menuBlank':'menuItem').'" href="'.self::formateUrl($t['url']).'" data-refresh="'.($t['is_refresh']?'true':'false').'">'.$t['name'].'</a></li>';
                        }

                    } else {
                        if($t['child'] && $deep<2){
                            $html .= '<li><a href="javascript:;">'.($t['icon']?'<i class="'.$t['icon'].'"></i>':'').' <span class="nav-label">'.$t['name'].'</span><span class="fa arrow"></span></a>';
                            $html.='<ul class="nav '.($deep==0?'nav-second-level':'nav-third-level').'">';
                            $html .= self::menuToHtml($t['child'],$t['id']);
                            $html = $html . "</ul></li>";
                        }
                    }
                }

            }
        }
        return $html ;
    }

    public static function formateUrl($url){
        if($url && strpos($url,'http')!==0){
            $url=Url::toRoute($url);
        }
        return $url;
    }
}
