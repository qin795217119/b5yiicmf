<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace common\helpers;

class TransformApi
{

    /**
     * 获取年龄
     * @param $start
     * @param $end
     * @return bool|int|mixed
     */
    public static function getAge($start, $end = '')
    {
        if (!$start) return false;
        $start = strtotime($start);
        if ($start === false) return false;

        if ($end) {
            $end = strtotime($end);
            if ($end === false) return false;
        } else {
            $end = time();
        }
        if ($end < $start) return false;
        list($y1, $m1, $d1) = explode("-", date("Y-m-d", $start));
        list($y2, $m2, $d2) = explode("-", date("Y-m-d", $end));
        $age = $y2 - $y1;
        if ((int)($m2 . $d2) < (int)($m1 . $d1))
            $age -= 1;
        return $age;
    }

    /**
     * 时间处理
     * @param $timestamp
     * @return false|string
     */
    public static function timeAgo($timestamp)
    {
        $counttime = time() - $timestamp;//相差时间戳
        if ($counttime <= 60) {
            return '刚刚';
        } else if ($counttime < 3600) {
            return intval(($counttime / 60)) . '分钟前';
        } else if ($counttime >= 3600 && $counttime < 3600 * 24) {
            return intval(($counttime / 3600)) . '小时前';
        } else if ($counttime <= 3600 * 24 * 10) {
            return intval(($counttime / (3600 * 24))) . '天前';
        } else {
            return date('Y-m-d', $timestamp);
        }
    }

    /**
     * 容量显示
     * @param $size
     * @return string
     */
    public static function sizeShow($size)
    {
        $size = intval($size);
        if ($size < 0) return '';
        $coin = 'Byte';
        $number = 0;
        $b_size = 1024;
        $kb_size = $b_size * 1024;
        $mb_size = $kb_size * 1024;
        $gb_size = $mb_size * 1024;
        if ($size >= 0 && $size < $b_size) {
            $number = $size;
        } elseif ($size >= $b_size && $size < $mb_size) {
            $number = floor(($size / $b_size) * 100) / 100;
            $coin = 'KB';
        } elseif ($size >= $mb_size && $size < $gb_size) {
            $number = floor(($size / $mb_size) * 100) / 100;
            $coin = 'MB';
        } else {
            $number = floor(($size / $gb_size) * 100) / 100;
            $coin = 'GB';
        }
        return $number . $coin;
    }
}