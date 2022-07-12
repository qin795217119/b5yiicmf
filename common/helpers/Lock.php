<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace common\helpers;

/**
 * redis/缓存锁，用于秒杀，并发库存
 * 需要在common\config下的 main.php中添加组件
 *
 *  'lock' => [
 *      'class' => 'yii\caching\FileCache',
 *   ]
 *  或者
 *  'lock' => [
 *       'class' => 'yii\redis\Cache',
 *   ]
 * @package common\helpers
 */
class Lock
{
    /**
     * 加锁
     * @param string $uniqueId
     * @param int $duration
     * @param bool $random //随机数，防止锁过期了但是程序还没执行完
     * @return false|int
     */
    public static function lockUp(string $uniqueId, $duration = 10,$random = true)
    {
        $lock = \Yii::$app->lock;
        if ($lock->exists($uniqueId)) {
            return false;
        } else {
            if($random){
                $rand = mt_rand(100,999);
            }else{
                $rand = 1;
            }
            //不存在才会设置成功
            $res = $lock->add($uniqueId,$rand,$duration);
            return $res?$rand:false;
        }
    }

    /**
     * 解锁
     * @param string $uniqueId
     * @param int $rand
     */
    public static function unLock(string $uniqueId,$random = -1)
    {
        $lock = \Yii::$app->lock;
        if($random<0 || $lock->get($uniqueId) == $random){
            $lock->delete($uniqueId);
        }
    }
}