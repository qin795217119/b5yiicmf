<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\helpers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use yii\web\HttpException;

class ExportHelper
{
    public $list = [];
    public $attributes = [];
    public $saveFile = true; //保存文件 还是 直接浏览器下载

    public function __construct(array $data){
        $this->list = isset($data['list'])?$data['list']:[];
        $this->attributes = isset($data['attributes'])?$data['attributes']:[];
    }

    /**
     * 导出
     * @return string
     * @throws HttpException
     */
    public function export():string{
        if(empty($this->attributes)){
            throw new HttpException(400,'未配置导出字段');
        }
        if(empty($this->list)){
            throw new HttpException(400,'导出数据为空');
        }

        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        //设置第一行的标题
        $index = 0;
        foreach ($this->attributes as $field=>$name){
            $index++;
            $worksheet->setCellValueByColumnAndRow($index, 1, $name);
        }

        //从第二行开始插入数据
        $row_index = 1;
        foreach ($this->list as $value){
            $row_index++;
            $column_index = 0;
            foreach ($this->attributes as $field=>$name){
                $column_index++;
                $worksheet->setCellValueByColumnAndRow($column_index, $row_index, $value[$field]);
            }
        }

        $fileName =  md5(microtime(true) . mt_rand(1000, 9999)).'.xlsx';

        //保存文档
        if($this->saveFile){
            $savePath = '/uploads/excel/'.date('Ymd');
            $path = str_replace('/',DIRECTORY_SEPARATOR,\Yii::getAlias('@root_path').$savePath);
            if (!is_dir($path)) {
                if (false === @mkdir($path, 0777, true) && !is_dir($path)) {
                    throw new HttpException(500,'存储文件夹创建失败：'.$path);
                }
            }
            try {
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer->save($path.DIRECTORY_SEPARATOR.$fileName);
            }catch (\Exception $exception){
                throw new HttpException(500,'文档创建失败：'.$exception->getMessage());
            }
            return $savePath.'/'.$fileName;
        }else{
            //直接浏览器下载
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$fileName.'"');
            header('Cache-Control: max-age=0');
            try {
                $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer->save('php://output');
            }catch (\Exception $exception){
                throw new HttpException(500,'文档创建失败：'.$exception->getMessage());
            }
            return '';
        }
    }

}