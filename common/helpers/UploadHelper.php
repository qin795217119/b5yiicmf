<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\helpers;

use common\cache\ConfigCache;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

class UploadHelper
{
    public $type = 'img'; //文件类型 img,file,video
    public $fileName = 'file';//上传文件名称
    public $cat = 'images';//路径前缀
    public $maxSize = 0; //文件最大 kb
    public $ext = []; //文件后缀
    public $savePath = '';//保存路径规格 Y代表为/年 M为/年/月  YM为/年月

    //缩略图设置，其中一个大于0则开启
    public $width = 0; //缩略图宽度
    public $height = 0;//缩略图高度

    public $water = false;//水印设置


    public function run()
    {
        $method = $this->type . 'Upload';
        if (method_exists($this, $method)) {
            if (!$this->fileName) $this->fileName = 'file';
            return $this->$method();
        } else {
            return Result::error('方法错误');
        }
    }

    /**
     * 图片上传
     */
    private function imgUpload()
    {
        if (!$this->cat) $this->cat = 'images';
        if (!$this->ext) $this->ext = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
        if ($this->maxSize < 1) $this->maxSize = 10 * 1024;//10M
        return $this->_upload();
    }

    /**
     * 视频上传
     */
    private function videoUpload()
    {
        if (!$this->cat) $this->cat = 'video';
        if (!$this->ext) $this->ext = ['mp4', 'm3u8', 'ogv', 'webm'];
        if ($this->maxSize < 1) $this->maxSize = 100 * 1024;//100M
        return $this->_upload();
    }


    /**
     * 文件上传
     */
    private function fileUpload()
    {
        if (!$this->cat) $this->cat = 'file';
        if ($this->maxSize < 1) $this->maxSize = 100 * 1024;//100M
        return $this->_upload();
    }

    /**
     * 上传操作
     */
    private function _upload()
    {
        $uploadObj = new UploadedFile();
        $fileObj = $uploadObj::getInstanceByName($this->fileName);
        if (!$fileObj || !is_object($fileObj)) {
            return Result::error('上传文件不能为空');
        }
        if ($fileObj->getHasError()) {
            if ($fileObj->error == 1) {
                $error = "上传错误:超出服务器限制";
            } else {
                $error = "上传错误:" . $fileObj->error;
            }
            return Result::error($error);
        }

        //验证大小和格式
        $thisExt = strtolower($fileObj->getExtension());
        if ($this->ext && !in_array($thisExt, $this->ext)) {
            return Result::error('格式只能是：' . implode('、', $this->ext));
        }
        $thisSize = $fileObj->size;
        if ($thisSize && $this->maxSize * 1024 < $thisSize) {
            return Result::error('文件超过最大限制:' . Transform::sizeFormat($this->maxSize * 1024));
        }


        //根路径
        $root = \Yii::getAlias('@root_path');
        //保存前地址
        $saveRoot = DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR;
        //保存路径
        $savePath = $this->getSavePath();

        //创建保存目录
        $uploads = $root. $saveRoot . $savePath . DIRECTORY_SEPARATOR;
        $fileHelper = FileHelper::createDirectory($uploads, 0777);
        if (!$fileHelper) {
            return Result::error('保存路径创建失败，请检查文件夹权限');
        }
        //定义保存名称
        $saveName = $this->getSaveName($fileObj);
        //存储文件的全目录
        $saveFullFile = $uploads.$saveName;
        if(!$fileObj->saveAs($saveFullFile)){
            return Result::error('上传失败');
        }
        //如果是图片 并且 生成缩略图或添加水印 这里为了逻辑清晰 先保存再处理，按理直接处理比较好
        $water_text = trim(ConfigCache::get('img_water_text_color', ''));
        if ($this->type == 'img' && ($this->width > 0 || $this->height > 0) || ($this->water && $water_text)) {
            if($this->width>0 || $this->height>0){
                $width = $this->width > 0 ? $this->width : null;
                $height = $this->height > 0 ? $this->height : null;
                Image::thumbnail($saveFullFile, $width, $height)->save($saveFullFile, ['quality' => 90]);
            }
            if($this->water && $water_text) {
                $color = ConfigCache::get('img_water_text_color');
                $font = ConfigCache::get('img_water_text_font');
                $font = $font ?: 16;
                $position = ConfigCache::get('img_water_text_position');
                $point = [10, 10];
                if ($position && $position != 'top_left') {
                    $len = strlen($water_text);
                    $text_wid = $len * $font;
                    $imgSize = Image::getImagine()->open($saveFullFile)->getSize();
                    $img_height = $imgSize->getHeight();
                    $img_width = $imgSize->getWidth();
                    if ($position == 'top_right') {
                        $point = [$img_width - $text_wid - 10, 10];
                    } elseif ($position == 'bottom_left') {
                        $point = [10, $img_height - 10 - $font];
                    } elseif ($position == 'bottom_right') {
                        $point = [$img_width - $text_wid - 10, $img_height - 10 - $font];
                    }
                }
                Image::text($saveFullFile, $water_text, '@root_path/common/helpers/fonts/HYZhongSongJ.ttf', $point, ['color' => $color ?: 'fff', $font, 'angle' => 0])->save($saveFullFile);
            }
        }
        $fullPath = str_replace(DIRECTORY_SEPARATOR,'/',$saveRoot.$savePath.DIRECTORY_SEPARATOR.$saveName);
        $data = [
            'path' => $fullPath,
            'url' => Functions::getFileUrl($fullPath),
            'originName' => $fileObj->getBaseName(),
            'ext' =>$thisExt
        ];


        return Result::success('上传成功', $data);
    }

    /**
     * 获取保存路径
     * @return string
     */
    public function getSavePath(): string
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
        $savePath = ($this->cat ? ($this->cat . DIRECTORY_SEPARATOR) : '') . $savePath;
        return $savePath;
    }

    /**
     * 获取保存名称
     * @param $fileObj
     * @return string
     */
    public function getSaveName($fileObj): string
    {
        return md5(microtime(true) . $fileObj->getBaseName()) . '.' . strtolower($fileObj->getExtension());
    }


}