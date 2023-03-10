<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace backend\extend\widgets;

use yii\base\Widget;


class Upload extends Widget
{
    public $type='';//img,file,video
    public $name = '';//标识
    public $extend=[];

    /**
     * img上传图片 name,title,link,tips,multi,width,height,cat,crop,data
     * file上传文件 name,title,tips,cat,place,data
     * video上传视频 name,title,tips,cat,exts,link,multi,inputname,data
     * ---------------------
     * name 为生成的input的name，也作为唯一标识，必须存在
     * title 上传按钮名称 可空
     * tips 提示信息文字 可空
     * cat 上传保存的文件夹 可空
     * data 已存在的链接字符串多个逗号隔开
     * link 是否显示输入input
     * multi 多文件上传数量
     * exts 文件后缀累心那个
     * ----------
     * @return string
     */
    public function run()
    {
        if($this->type && $this->name){
            $extend=$this->extend?:[];
            $extend['name'] = $this->name;
            return $this->render('upload'.DIRECTORY_SEPARATOR.trim($this->type),['widget_data'=>$extend]);
        }
        return '';
    }

}