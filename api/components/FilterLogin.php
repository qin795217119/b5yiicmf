<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace api\components;

use common\helpers\Result;
use yii\base\ActionFilter;
use Yii;

/**
 * 判断token的过滤器
 * Class FilterLogin
 * @package api\components
 */
class FilterLogin extends ActionFilter
{
    use TraitToken;

    /**
     * 平台类型
     * @var string
     */
    public string $type = '';

    /**
     * 接口登录参数
     * @var string
     */
    public string $key = 'token';

    /**
     * 方法前执行操作
     * @param yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action): bool
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        $token = Yii::$app->request->post($this->key, '');
        if (!$token) $token = Yii::$app->request->get($this->key, '');
        $token_record = $this->getToken($token,$this->type);
        if (!$token_record) {
            Yii::$app->response->data = Result::error('请先登录', 305);
            return false;
        }
        //将token信息传递
        $bodyParams = Yii::$app->request->bodyParams;
        $bodyParams['__token'] = $token_record;
        Yii::$app->request->setBodyParams($bodyParams);
        return true;
    }
}