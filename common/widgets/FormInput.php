<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\widgets;

use yii\bootstrap\Widget;

/**
 * 常用的表单组件
 * Class FormInput
 * @package common\widgets
 */
class FormInput extends Widget
{
    public $name='';
    public $extend=[];
    public function run()
    {
        if($this->name){
            if(strpos($this->name,'|')!==false){
                list($type,$title)=explode('|',trim($this->name),2);
            }else{
                $type=$this->name;
                $title='';
            }
            if($type){
                $extend=$this->extend?:[];
                $extend['title']=$extend['title']??$title;
                $extend['id']=$extend['id']??'';
                $extend['class']=$extend['class']??'';
                $extend['name']=$extend['name']??'';
                return $this->render('forminput'.DIRECTORY_SEPARATOR.trim($type),['widget_data'=>$extend]);
            }
        }
        return '';
    }

}