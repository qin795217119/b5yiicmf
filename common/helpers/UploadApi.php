<?php

namespace common\helpers;

use common\cache\ConfigCache;
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

    public $water = false;
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
     */
    private function imgUpload()
    {
        if (!$this->cat) $this->cat = 'images';
        if (!$this->ext) $this->ext = ['jpg', 'jpeg', 'gif', 'png'];
        if ($this->maxSize < 1) $this->maxSize = 10 * 1024;//10M
        return $this->_upload();
    }

    /**
     * 视频上传
     * @return array
     */
    private function videoUpload(){
        if (!$this->cat) $this->cat = 'video';
        if (!$this->ext) $this->ext = ['mp4','m3u8','ogv','webm'];
        if ($this->maxSize < 1) $this->maxSize = 100 * 1024;//100M
        return $this->_upload();
    }



    /**
     * 文件上传
     * @return array
     */
    private function fileUpload()
    {
        if (!$this->cat) $this->cat = 'file';
        if ($this->maxSize < 1) $this->maxSize = 100 * 1024;//100M
        return $this->_upload();
    }

    private function _upload(){
        $uploadObj = new UploadedFile();
        $fileObj = $uploadObj::getInstanceByName($this->fileName);
        if (!$fileObj || !is_object($fileObj)) {
            return commonApi::message('未获取上传文件', false);
        }
        if ($fileObj->getHasError()) {
            if ($fileObj->error == 1) {
                $error = "上传错误:超出服务器限制";
            } else {
                $error = "上传错误:" . $fileObj->error;
            }
            return commonApi::message($error, false);
        }
        $thisExt = strtolower($fileObj->getExtension());
        if ($this->ext && !in_array($thisExt, $this->ext)) {
            return commonApi::message('文件格式错误：' . implode('、', $this->ext), false);
        }
        $thisSize = $fileObj->size;
        if ($thisSize && $this->maxSize * 1024 < $thisSize) {
            $showSize = TransformApi::sizeShow($this->maxSize * 1024);
            return commonApi::message('文件超过最大限制:' . $showSize, false);
        }

        $rootPath = Yii::getAlias('@approot');
        $savePath = $this->getSavePath();//保存路径
        $uploads = $rootPath . DIRECTORY_SEPARATOR . $savePath;

        $fileHelper = FileHelper::createDirectory($uploads, 0777);
        if (!$fileHelper) {
            return commonApi::message('保存路径创建失败', false);
        }
        $originName = $fileObj->getBaseName();//源文件名
        $fileName = $this->getFileName($originName);//获取文件名
        $fileFullName = $fileName . '.' . $thisExt;

        $saveFullFile = $uploads . DIRECTORY_SEPARATOR . $fileFullName;//保存的完整路径和文件名

        $filePath = DIRECTORY_SEPARATOR . trim($savePath . DIRECTORY_SEPARATOR . $fileFullName, DIRECTORY_SEPARATOR);
        $filePath = str_replace(DIRECTORY_SEPARATOR, '/', $filePath);//前端显示文件地址


        if ($fileObj->saveAs($saveFullFile)) {
            if($this->type == 'img'){
                if ($this->width > 0 || $this->height > 0) {
                    $width = $this->width > 0 ? $this->width : null;
                    $height = $this->height > 0 ? $this->height : null;
                    Image::thumbnail($saveFullFile, $width, $height, ManipulatorInterface::THUMBNAIL_OUTBOUND)->save($saveFullFile, ['quality' => 90]);
                }

                //水印
                $water_text = ConfigCache::get('img_water_text');
                if($water_text && $this->water){
                    $color = ConfigCache::get('img_water_text_color');
                    $font = ConfigCache::get('img_water_text_font');
                    $font=$font?:16;
                    $position = ConfigCache::get('img_water_text_position');
                    $point= [10,10];
                    $canWater = false;
                    if($position && $position!='top_left'){
                        $len = strlen($water_text);
                        $len1 = mb_strlen($water_text);
                        $clen = ceil(($len-$len1)/2);
                        $text_wid = ceil($len1*$font/2 +$clen*$font/2);
                        $imgSize =Image::getImagine()->open($saveFullFile)->getSize();
                        $img_height = $imgSize->getHeight();
                        $img_width = $imgSize->getWidth();
                        $min_height = $font + 20;
                        $min_width = $text_wid+20;
                        if($img_height>=$min_height && $img_width>=$min_width){
                            $canWater = true;
                        }
                        if ($position == 'top_right'){
                            $point= [$img_width-$text_wid-10,10];
                        }elseif ($position == 'bottom_left'){
                            $point= [10,$img_height-10-$font];
                        }elseif ($position == 'bottom_right'){
                            $point= [$img_width-$text_wid-10,$img_height-10-$font];
                        }
                    }
                    if($canWater){
                        Image::text($saveFullFile,$water_text,'@approot/public/static/common/fonts/HYZhongSongJ.ttf',$point,  ['color'=>$color?:'fff',$font,'angle'=>0])->save($saveFullFile);
                    }
                }
            }

            $data = [
                'path' => $filePath,
                'url' => commonApi::get_image_url($filePath),
                'originName' => $originName,
                'ext' => $thisExt,
                'size' => $thisSize,
            ];
            return commonApi::message('上传成功', true, $data);
        } else {
            return commonApi::message('上传失败', false);
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
        $this->cat = str_replace('/',DIRECTORY_SEPARATOR,$this->cat);
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