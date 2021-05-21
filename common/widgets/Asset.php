<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\widgets;

use yii\bootstrap\Widget;

/**
 * 加载js插件
 * Class Asset
 * @package common\widgets
 */
class Asset extends Widget
{
    public $type=[];//加载的插件
    public function run()
    {
        if($this->type){
            $css=[];
            $js=[];
            foreach ($this->type as $type){
                $info=$this->assetList($type);
                if($info){
                    $css=array_merge($css,$info['css']);
                    $js=array_merge($js,$info['js']);
                }
            }
            if($css || $js){
                $css=array_unique($css);
                $js=array_unique($js);
                return $this->render('asset',['css'=>$css,'js'=>$js]);
            }
        }
        return '';
    }

    /**
     * 资源插件列表
     * @param string $key
     * @return array|mixed
     */
    private function assetList($key=''){
        $list=[
            'dragula'=>[
                'css'=>['dragula/dragula.min.css'],
                'js'=>['dragula/dragula.min.js']
            ],
            'select2'=>[
                'css'=>['select2/select2.min.css','select2/select2-bootstrap.css'],
                'js'=>['select2/select2.min.js']
            ],
            'summernote'=>[
                'css'=>['summernote/summernote.min.css'],
                'js'=>['summernote/summernote.min.js','summernote/lang/summernote-zh-CN.min.js']
            ],
            'treetable'=>[
                'css'=>[],
                'js'=>['bootstrap-treetable/bootstrap-treetable.js']
            ],
            'ztree'=>[
                'css'=>['ztree/css/metroStyle/metroStyle.css'],
                'js'=>['ztree/js/jquery.ztree.all.min.js','ztree/js/jquery.ztree.exhide.min.js']
            ],
            'jquery-layout'=>[
                'css'=>['jquery-layout/layout-default.css'],
                'js'=>['jquery-layout/jquery.layout.min.js']
            ],
            'mypicker'=>[
                'css'=>[],
                'js'=>['My97DatePicker/WdatePicker.js']
            ]
        ];
        return $key?($list[$key]??[]):[];
    }
}