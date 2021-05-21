<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\helpers;

use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;


class UploadApi
{
    public $type = 'img'; //文件类型 img,file
    public $fileName = 'file';//上传文件名称
    public $cat = 'images';//路径前缀
    public $maxSize = 0; //文件最大 kb
    public $ext = []; //文件后缀
    public $saveName = '';//保存文件名
    public $savePath = '';//保存路径规格 Y代表为/年 M为/年/月  YM为/年月
    public $root = 'uploads';//根目录

    public $width = 0;
    public $height = 0;

    public function run()
    {
        $method = $this->type . 'Upload';
        if (method_exists($this, $method)) {
            if (!$this->fileName) $this->fileName = 'file';
            return $this->$method();
        } else {
            return commonApi::message('方法错误', false);
        }
    }

    /**
     * 图片上传
     * @return array
     * @throws \yii\base\Exception
     */
    private function imgUpload()
    {
        if (!$this->cat) $this->cat = 'images';
        if (!$this->ext) $this->ext = ['jpg', 'jpeg', 'gif', 'png'];
        if ($this->maxSize < 1) $this->maxSize = 10 * 1024;//10M
        $uploadobj = new UploadedFile();
        $image = $uploadobj::getInstanceByName($this->fileName);
        if (!$image || !is_object($image)) {
            return commonApi::message('未获得上传图片文件', false);
        }
        if ($image->getHasError()) {
            if ($image->error == 1) {
                $error = "图片上传错误:超出服务器限制";
            } else {
                $error = "图片上传错误:" . $image->error;
            }
            return commonApi::message($error, false);
        }
        $thisext = strtolower($image->getExtension());
        if (!in_array($thisext, $this->ext)) {
            return commonApi::message('图片后缀为：' . implode('、', $this->ext), false);
        }
        $thissize = $image->size;
        if ($thissize && $this->maxSize * 1024 < $thissize) {
            $showSize = TransformApi::sizeShow($this->maxSize * 1024);
            return commonApi::message('图片最大为:' . $showSize, false);
        }

        $rootPath = Yii::getAlias('@approot');
        $savePath = $this->getSavePath();//保存路径
        $uploads = $rootPath . DIRECTORY_SEPARATOR . $savePath;

        $filehelper = FileHelper::createDirectory($uploads, 0777);
        if (!$filehelper) {
            return commonApi::message('保存路径创建失败', false);
        }

        $originName = $image->getBaseName();//源文件名
        $fileName = $this->getFileName($originName);//获取文件名
        $fileFullName = $fileName . '.' . $thisext;

        $saveFullFile = $uploads . DIRECTORY_SEPARATOR . $fileFullName;//保存的完整路径和文件名

        $filePath = DIRECTORY_SEPARATOR . trim($savePath . DIRECTORY_SEPARATOR . $fileFullName, DIRECTORY_SEPARATOR);
        $filePath = str_replace(DIRECTORY_SEPARATOR, '/', $filePath);//前端显示文件地址

        if ($image->saveAs($saveFullFile)) {
            if ($this->width > 0 || $this->height > 0) {
                $width = $this->width > 0 ? $this->width : null;
                $height = $this->height > 0 ? $this->height : null;
                Image::thumbnail($saveFullFile, $width, $height, ManipulatorInterface::THUMBNAIL_OUTBOUND)->save($saveFullFile, ['quality' => 90]);
            }
            $data = [
                'path' => $filePath,
                'url' => commonApi::get_image_url($filePath),
                'originName' => $originName,
                'ext' => $thisext,
                'size' => $thissize,
            ];
            return commonApi::message('图片上传成功', true, $data);
        } else {
            return commonApi::message('图片上传失败', false);
        }
    }

    /**
     * 获取保存路径
     * @return false|string
     */
    private function getSavePath()
    {
        if (!$this->savePath || $this->savePath == 'D') {
            $savePath = date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d');
        } elseif ($this->savePath == 'Y') {
            $savePath = date('Y');
        } elseif ($this->savePath == 'M') {
            $savePath = date('Y') . DIRECTORY_SEPARATOR . date('m');
        } elseif ($this->savePath == 'YM') {
            $savePath = date('Ym');
        } else {
            $savePath = $this->savePath;
        }
        return ($this->root ? ($this->root . DIRECTORY_SEPARATOR) : '') . ($this->cat ? ($this->cat . DIRECTORY_SEPARATOR) : '') . $savePath;
    }

    /**
     * 获取文件名称
     * @param $originName
     * @return string
     */
    private function getFileName($originName)
    {
        $fileName = $this->saveName;
        if (!$fileName) {
            $fileName = md5($originName . time() . mt_rand(1000, 9999));
        }
        return $fileName;
    }

}