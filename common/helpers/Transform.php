<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace common\helpers;

class Transform
{


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
     * @param int $size 字节
     * @return string
     */
    public static function sizeFormat(int $size)
    {
        if ($size < 0) return '';
        $coin = 'Byte';
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
	
	/**
     * 将数组中的根节点的父级重置
     * @param array $list
     * @param string $idField
     * @param string $parentField
     * @param int $resetValue
     * @return array
     */
    public static function listRootReset(array $list,string $idField = 'id',string $parentField='parent_id', $resetValue = 0): array
    {
        $idList = [];
        foreach ($list as $key=>$value){
            if(!in_array($value[$idField],$idList)){
                $idList[] = $value[$idField];
            }
        }

        foreach ($list as $key=>$value){
            if(!in_array($value[$parentField],$idList)) {
                $value[$parentField] = $resetValue;
                $list[$key] = $value;
            }
        }
        return $list;
    }
}