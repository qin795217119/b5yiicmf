<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace api\components;


use yii\db\Exception;

/**
 * 设置token和查询token
 * Trait TraitToken
 * @package api\components
 */
trait TraitToken
{
    /**
     * 存储token的表名
     * 字段有 token,user_id,type(用户类型),plat(多平台),extend(额外信息)
     * @var string
     */
    protected string $token_table = 'b5net_app_token';

    /**
     * 查询token信息
     * @param string $token
     * @param string $type 用户类型
     * @param string $plat 平台
     * @return array|false|\yii\db\DataReader
     */
    protected function getToken(string $token = '', string $type = 'user', string $plat = 'app')
    {
        if (!$token) return false;
        $token = trim($token);
        if (!ctype_alnum($token)) return false;
        if (strlen($token) != 32) return false;
        try {
            $record = \Yii::$app->db->createCommand('SELECT * FROM ' . $this->token_table . ' WHERE token = :token')->bindValue(':token', $token)->queryOne();
        } catch (Exception $e) {
            $record = false;
        }
        if (!$record) return false;
        if ($record['plat'] !== $plat) {
            return false;
        }
        if ($record['type'] !== $type) {
            return false;
        }
        if ($record['exp_time'] < time()) {
            return false;
        }
        return $record;
    }

    /**
     * 设置token
     * @param $id
     * @param string $type
     * @param string $plat
     * @param string $extend
     * @return false|string
     */
    protected function setToken($id, string $type = 'user',string $plat = 'app' ,string $extend = '')
    {
        if (!$id) return false;
        try {
            $record = \Yii::$app->db->createCommand('SELECT * FROM ' . $this->token_table . ' WHERE user_id=:user_id AND type = :type AND plat = :plat')->bindValue(':user_id', $id)->bindValue(':type', $type)->bindValue(':plat', $plat)->queryOne();
        } catch (Exception $e) {
            $record = false;
        }

        $nowTime = time();
        $key = $id . $nowTime . $type. $plat . mt_rand(100, 999);
        $token = md5($key);
        $exp_time = $nowTime + 7 * 24 * 3600;
        if ($record) {
            try {
                $result = \Yii::$app->db->createCommand()->update($this->token_table, ['token' => $token, 'exp_time' => $exp_time,'extend'=>$extend], "token = '".$record['token']."'")->execute();
            } catch (Exception $e) {
                $result = false;
            }
        } else {
            try {
                $result = \Yii::$app->db->createCommand()->insert($this->token_table, ['user_id' => $id, 'type' => $type, 'plat' => $plat, 'token' => $token, 'extend' => $extend, 'exp_time' => $exp_time])->execute();
            } catch (Exception $e) {
                $result = false;
            }
        }
        return $result?$token:false;
    }
}