<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: b5net <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\helpers;


use moonland\phpexcel\Excel;
use yii\helpers\FileHelper;

class AdminExportApi
{
    public static function run($model,$data){

        $rootPath = \Yii::getAlias('@approot');
        $savePath =  'uploads' . DIRECTORY_SEPARATOR . 'export'.DIRECTORY_SEPARATOR.'excel'.DIRECTORY_SEPARATOR.date('Y-m');
        $uploads = $rootPath . DIRECTORY_SEPARATOR . $savePath;

        $fileHelper = FileHelper::createDirectory($uploads, 0777);
        if (!$fileHelper) {
            return commonApi::message('保存路径创建失败', false);
        }

        $columns = $data['columns']??[];
        if(!$columns){
            $model = new $model();
            if(method_exists($model,'exportField')){
                $columns = $model->exportField();
            }
        }

        $fileName =  md5(time() . mt_rand(1000, 9999)).'.xlsx';
        Excel::export([
            'savePath'=>$uploads,
            'fileName'=>$fileName,
            'models'=>$data['list']??[],
            'columns'=>$columns,
            'headers'=>$data['headers']??[],
        ]);
        $fileUrl = DIRECTORY_SEPARATOR.$savePath.DIRECTORY_SEPARATOR.$fileName;
        $fileUrl = str_replace(DIRECTORY_SEPARATOR, '/', $fileUrl);
        return commonApi::message($fileUrl,true);
    }

}