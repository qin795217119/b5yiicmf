<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\modules\demo\controllers;

use backend\extend\BaseController;
use common\helpers\Str;

class ToolController extends BaseController
{
    /**
     * 表单构建
     * @return string
     */
    public function actionBuild(){

        return $this->render();
    }

    /**
     * 代码生成
     */
    public function actionCreate(){
        if($this->request->isPost){
            $params = $this->request->post();
            $table = $params['table']??'';
            $class = $params['class']??'';
            $dir = $params['dir']??'';
            if(empty($table)) return $this->error('请选择表名');
            if(empty($class)) return $this->error('请输入类名称');

            $table_exists = \Yii::$app->db->createCommand("show tables like '".$table."'")->query();
            if(!$table_exists) return $this->error('表'.$table.'不存在');

            return $this->genCode($table,$class,$dir);

        }else{
            $systemList = ['b5net_admin','b5net_admin_role','b5net_admin_struct','b5net_config','b5net_loginlog','b5net_menu','b5net_notice','b5net_role','b5net_role_menu','b5net_role_struct','b5net_struct','b5net_wechat_users','b5net_wechat_access','b5net_smscode','demo_media'];
            $tables = \Yii::$app->db->createCommand("show tables")->queryAll();
            $tableList = [];
            foreach ($tables as $value){
                $table = current($value);
                if(!in_array($table,$systemList)){
                    $tableList[]=$table;
                }
            }
            $expt = ['debug','gii'];
            $modules = [];
            foreach (\Yii::$app->modules as $key=>$module){
                if(!in_array($key,$expt)){
                    $modules[]= $key;
                }
            }
            return $this->render('',['tableList'=>$tableList,'modules'=>$modules]);
        }

    }

    private function genCode($table,$class,$dir){
        $model_name = Str::studly($class);//生成模型的名称大驼峰

        $fields = $this->getFields($table);
        if(!$fields){
            return $this->error('获取表结构失败');
        }
        if(true !== $res = $this->createModel($fields,$table,$model_name,$dir)){
            return $res;
        }
        if(true !== $res = $this->createController($model_name,$dir)){
            return $res;
        }
        if(true !== $res = $this->createIndex($fields,$model_name,$dir)){
            return $res;
        }
        if(true !== $res = $this->createAdd($fields,$model_name,$dir)){
            return $res;
        }
        if(true !== $res = $this->createEdit($fields,$model_name,$dir)){
            return $res;
        }
        return $this->success('生成完成');
    }

    //生成模型
    private function createModel($fields,$table,$model_name,$dir){
        $root = \Yii::getAlias('@root_path');//根地址

        $model_path_name = $model_name;
        if($dir) {
            $model_path_name = $dir . '/' . $model_name;
            $dir='\\'.$dir;
        }

        //模型路径并创建
        $model_path = str_replace('/',DIRECTORY_SEPARATOR,$root."/common/models".$dir);
        if(true !== $res = $this->mkdir($model_path)){
            return $res;
        }

        //* @property int $id
        $property='';
        $rules ='';
        $attribute='';
        $fieldArr = [];
        foreach ($fields as $value){
            $data_type = $this->fieldType($value['data_type']);
            if(is_null($value['column_default']) && $value['column_name']!='id'){
                $data_type.='|null';
            }
            $property.=" * @property ".$data_type." $".$value['column_name']."  ".$value['column_comment']."\r\n";
            if($value['column_name']!='id'){
                $rules.="'".$value['column_name']."',";
            }
            $attribute.="            '".$value['column_name']."' => '".($value['column_comment']?:Str::ucWords($value['column_name']))."',\r\n";
            $fieldArr[]=$value['column_name'];
        }
        $rules = trim($rules,',');
        if(in_array('create_time',$fieldArr) && in_array('update_time',$fieldArr)){
            $timeAutoHtml = "
    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['create_time','update_time'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
                ],
                'value'=>function(){
                    return (new \DateTime())->format('Y-m-d H:i:s');
                }
            ]
        ];
    }";
        }else{
            $timeAutoHtml='';
        }

        //模型的示例代码
        $temp_path =  str_replace('/',DIRECTORY_SEPARATOR,$root.'/backend/modules/demo/views/tool/create/model.tpl');
        $gen_path =  str_replace('/',DIRECTORY_SEPARATOR,$root."/common/models/".$model_path_name.".php");//生成的模型地址
        $tem_f = fopen($temp_path,"r");
        $temp_str = fread($tem_f,filesize($temp_path));
        $temp_str = str_replace(['{$model}','{$table}','{$dir}','__property__','__rules__','__attribute__','__time__'],[$model_name,$table,$dir,$property,$rules,$attribute,$timeAutoHtml],$temp_str);
        $gen_model=fopen($gen_path,'w');
        fwrite($gen_model,$temp_str);
        return true;
    }

    //生成控制器
    private function createController($model_name,$dir){
        $root = \Yii::getAlias('@root_path');//根地址
        $controller_name = ucfirst(strtolower($model_name));//生成控制器名称

        $model_use = $model_name;
        if($dir) {
            $model_use = $dir.'\\'.$model_name;
            $dir='\\modules\\'.$dir;
        }

        //路径并创建
        $model_path = str_replace('/',DIRECTORY_SEPARATOR,$root."/backend".$dir."/controllers");
        if(true !== $res = $this->mkdir($model_path)){
            return $res;
        }

        //的示例代码
        $temp_path =  str_replace('/',DIRECTORY_SEPARATOR,$root.'/backend/modules/demo/views/tool/create/controller.tpl');
        $gen_model_path =  str_replace('/',DIRECTORY_SEPARATOR,$root."/backend".$dir."/controllers/".$controller_name."Controller.php");//生成的模型地址
        $tem_f = fopen($temp_path,"r");
        $temp_str = fread($tem_f,filesize($temp_path));
        $temp_str = str_replace(['{$dir}','{$model_use}','{$controller}','{$model}'],[$dir,$model_use,$controller_name,$model_name],$temp_str);
        $gen_model=fopen($gen_model_path,'w');
        fwrite($gen_model,$temp_str);
        return true;
    }

    //创建index.html
    private function createIndex($fields,$model_name,$dir){
        $root = \Yii::getAlias('@root_path');//根地址
        $path_name = strtolower($model_name);//文件夹
        if($dir){
            $dir = '/modules/'.$dir;
        }

        //路径并创建
        $path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/backend'.$dir.'/views/'.$path_name);
        if(true !== $res = $this->mkdir($path)){
            return $res;
        }
        //index.html的示例代码
        $temp_index_path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/backend/modules/demo/views/tool/create/index.tpl');
        //生成的index.html地址
        $gen_index_path = $path.DIRECTORY_SEPARATOR.'index.php';
        $tem_index_f = fopen($temp_index_path,"r");
        $temp_index_str = fread($tem_index_f,filesize($temp_index_path));
        $html='';
        $fieldArr = [];
        foreach ($fields as $value){
            $fieldArr[] = $value['column_name'];
            if($value['column_name'] =='id' || $value['column_name'] =='create_time' || $value['column_name'] =='update_time'){
                continue;
            }
            $html.="                {field: '".$value['column_name']."', title: '".($value['column_comment']?:$value['column_name'])."', align: 'center'},\r\n";
        }
        if(in_array('create_time',$fieldArr) && in_array('update_time',$fieldArr)){
            $time = "                {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},";
        }else{
            $time='';
        }
        $temp_index_str = str_replace(['___REPLACE___','__TIME__'],[$html,$time],$temp_index_str);
        $gen_index=fopen($gen_index_path,'w');
        fwrite($gen_index,$temp_index_str);
        return true;
    }

    //创建add.html
    private function createAdd($fields,$model_name,$dir){
        $root = \Yii::getAlias('@root_path');//根地址
        $path_name = strtolower($model_name);//文件夹
        if($dir){
            $dir = '/modules/'.$dir;
        }

        //路径并创建
        $path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/backend'.$dir.'/views/'.$path_name);
        if(true !== $res = $this->mkdir($path)) {
            return $res;
        }
        //模板
        $temp_add_path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/backend/modules/demo/views/tool/create/add.tpl');
        //生成地址
        $gen_add_path = $path.DIRECTORY_SEPARATOR.'add.php';
        $tem_add_f = fopen($temp_add_path,"r");
        $temp_add_str = fread($tem_add_f,filesize($temp_add_path));
        $html='';
        foreach ($fields as $value){
            if($value['column_name'] =='id' || $value['column_name'] =='create_time' || $value['column_name'] =='update_time'){
                continue;
            }
            $html.='    <div class="form-group">
        <label class="col-sm-3 control-label is-required">'.($value['column_comment']?:$value['column_name']).'：</label>
        <div class="col-sm-8">
            <input type="text" name="'.$value['column_name'].'" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>'."\r\n";
        }
        $temp_add_str = str_replace('___REPLACE___',$html,$temp_add_str);
        $gen_add=fopen($gen_add_path,'w');
        fwrite($gen_add,$temp_add_str);
        return true;
    }

    private function createEdit($fields,$model_name,$dir){
        $root = \Yii::getAlias('@root_path');//根地址
        $path_name = strtolower($model_name);//文件夹
        if($dir){
            $dir = '/modules/'.$dir;
        }

        //路径并创建
        $path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/backend'.$dir.'/views/'.$path_name);
        if(true !== $res = $this->mkdir($path)) {
            return $res;
        }
        $temp_edit_path = str_replace('/',DIRECTORY_SEPARATOR,$root.'/backend/modules/demo/views/tool/create/edit.tpl');
        $gen_edit_path = $path.DIRECTORY_SEPARATOR.'edit.php';
        $tem_edit_f = fopen($temp_edit_path,"r");
        $temp_edit_str = fread($tem_edit_f,filesize($temp_edit_path));
        $html='';
        foreach ($fields as $value){
            if($value['column_name'] =='id' || $value['column_name'] =='create_time' || $value['column_name'] =='update_time'){
                continue;
            }
            $html.='    <div class="form-group">
        <label class="col-sm-3 control-label is-required">'.($value['column_comment']?:$value['column_name']).'：</label>
        <div class="col-sm-8">
            <input type="text" name="'.$value['column_name'].'" value="<?=$info[\''.$value['column_name'].'\']?>" class="form-control" required autocomplete="off"/>
        </div>
    </div>'."\r\n";
        }
        $temp_edit_str = str_replace('___REPLACE___',$html,$temp_edit_str);
        $gen_edit=fopen($gen_edit_path,'w');
        fwrite($gen_edit,$temp_edit_str);
        return true;
    }
    //创建文件夹
    private function mkdir($path){
        if (!is_dir($path)) {
            if (false === @mkdir($path, 0777, true) && !is_dir($path)) {
                return $this->error('创建文件夹失败:'.$path);
            }
        }
        return true;
    }
    //获取字段列表
    private function getFields($table){
        //获取字段信息
        $dbname = '';
        if(preg_match('/dbname=([^;]*)/', \Yii::$app->db->dsn, $match)){
            $dbname = $match[1];
        }
        if(!$dbname){
            return false;
        }

        $result = \Yii::$app->db->createCommand("select column_name,column_comment,data_type,column_default from INFORMATION_SCHEMA.Columns where table_name='".$table."' and table_schema='".$dbname."'")->queryAll();
        if(!$result){
            return false;
        }
        return $result;
    }
    //判断字段类型
    private function fieldType($type){
        $int = ['tinyint','smallint','mediumint','int','integer','bigint','timestamp'];
        $float = ['decimal','float','double','numeric'];
        if(in_array($type,$int)){
            return 'int';
        }
        if(in_array($type,$float)){
            return 'float';
        }
        return 'string';
    }
}
