<?php
    if($name){
        if(strpos($name,'|')!==false){
            list($type,$title)=explode('|',trim($name),2);
        }else{
            $type=$name;
            $title='';
        }

        if($type){
            $extend=$extend??[];
            $extend['title']=$extend['title']??$title;
            $extend['id']=$extend['id']??'';
            $extend['class']=$extend['class']??'';
            $extend['name']=$extend['name']??'';
            echo $this->render('widget'.DIRECTORY_SEPARATOR.'iframe'.DIRECTORY_SEPARATOR.trim($type),['widget_data'=>$extend]);
        }
    }
?>