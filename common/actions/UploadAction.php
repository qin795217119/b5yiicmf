<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\actions;

use common\helpers\UploadHelper;
use yii\base\Action;
use yii\web\HttpException;
use Yii;

class UploadAction extends Action
{
    public $type = '';
    public $cat = '';
    public $ext = [];
    public $maxSize = 0;
    public $width = 0;
    public $height = 0;
    public $water = false;

    public function run()
    {
        $method = $this->type . 'Upload';
        if (!method_exists($this, $method)) {
            throw new HttpException(400,'上传类型错误');
        }
        return $this->$method();
    }

    private function imgUpload()
    {
        if ($this->width <= 0 && $this->height <= 0) {
            $this->width = intval(Yii::$app->request->post('width', 0));
            $this->height = intval(Yii::$app->request->post('height', 0));
        }
        if (!$this->cat) {
            $this->cat = Yii::$app->request->post('cat', '');
        }

        $upload = new UploadHelper();
        $upload->type = 'img';
        $upload->cat = $this->cat;
        $upload->water = $this->water;
        $upload->ext = $this->ext;
        $upload->width = $this->width;
        $upload->height = $this->height;
        $upload->maxSize = $this->maxSize;

        return $upload->run();
    }

    private function fileUpload()
    {
        if (!$this->cat) {
            $this->cat = Yii::$app->request->post('cat', '');
        }
        $upload = new UploadHelper();
        $upload->type = 'file';
        $upload->cat = $this->cat;
        return $upload->run();
    }

    private function videoUpload()
    {
        if (!$this->cat) {
            $this->cat = Yii::$app->request->post('cat', '');
        }
        $upload = new UploadHelper();
        $upload->type = 'video';
        $upload->cat = $this->cat;
        return $upload->run();
    }
}