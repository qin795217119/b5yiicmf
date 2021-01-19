<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\actions;

use common\helpers\commonApi;
use common\helpers\UploadApi;
use yii\base\Action;
use Yii;

class UploadAction extends Action
{
    public $type = '';
    public $cat = '';
    public $ext = [];
    public $maxSize = 0;
    public $width = 0;
    public $height = 0;

    public function run()
    {
        $method = $this->type . 'Upload';
        if (!method_exists($this, $method)) {
            return commonApi::message('上传类型错误', false);
        }
        return $this->$method();
    }

    private function imgUpload()
    {
        $filename = Yii::$app->request->post('file_field', '');
        if ($this->width <= 0 && $this->height <= 0) {
            $this->width = intval(Yii::$app->request->post('width', 0));
            $this->height = intval(Yii::$app->request->post('height', 0));
        }
        if (empty($this->cat)) {
            $this->cat = Yii::$app->request->post('cat', '');
        }

        $upload = new UploadApi();
        $upload->fileName = $filename;
        $upload->type = 'img';
        $upload->cat = $this->cat;
        $upload->ext = $this->ext;
        $upload->width = $this->width;
        $upload->height = $this->height;
        $upload->maxSize = $this->maxSize;

        return $upload->run();
    }

    private function fileUpload($type, $rearr)
    {

    }

    private function videoUpload($type, $rearr)
    {

    }
}