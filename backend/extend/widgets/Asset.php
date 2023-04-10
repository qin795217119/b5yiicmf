<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace backend\extend\widgets;


use yii\base\Widget;

/**
 * 加载js插件
 * Class Asset
 * @package common\widgets
 */
class Asset extends Widget
{
    public $type=[];//加载的插件

    /**
     * 运行资源加载
     * @return string
     */
    public function run():string
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
     * @return array
     */
    private function assetList(string $key=''):array{
        $list=[
            'export'=>[
                'css'=>[],
                'js'=>['bootstrap-table/extensions/export/tableExport.js','bootstrap-table/extensions/export/bootstrap-table-export.js']
            ],
            'dragula'=>[
                'css'=>['dragula/dragula.min.css'],
                'js'=>['dragula/dragula.min.js']
            ],
            'select2'=>[
                'css'=>['select2/select2.min.css','select2/select2-bootstrap.css'],
                'js'=>['select2/select2.js']
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
            ],
            'viewer'=>[
                'css'=>['viewerjs/viewer.min.css'],
                'js'=>['viewerjs/viewer.min.js']
            ],
            'echarts'=>[
                'css'=>[],
                'js'=>['echarts/echarts.min.js']
            ],
            'cropper'=>[
                'css'=>['cropper/cropper.min.css'],
                'js'=>['cropper/cropper.min.js','cropper/jquery-cropper.min.js']
            ],
            'beautifyhtml'=>[
                'css'=>[],
                'js'=>['beautifyhtml/beautifyhtml.js']
            ],
            'jquery-ui'=>[
                'css'=>[],
                'js'=>['jquery-ui-1.10.4.min.js']
            ],
            'uploader'=>[
                'css'=>[],
                'js'=>['uploader.js']
            ],
            'vue'=>[
                'css'=>[],
                'js'=>['vue/vue.min.js']
            ],
            'dayjs'=>[
                'css'=>[],
                'js'=>['dayjs/dayjs.min.js']
            ],
            'fixed-columns'=>[
                'css'=>[],
                'js'=>['bootstrap-table/extensions/columns/bootstrap-table-fixed-columns.min.js']
            ]
        ];
        return $key?($list[$key]??[]):[];
    }
}