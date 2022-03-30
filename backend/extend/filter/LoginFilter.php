<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\extend\filter;

use backend\extend\helpers\LoginAuthHelper;
use backend\extend\models\LoginForm;
use common\helpers\Result;
use yii\base\ActionFilter;
use Yii;
use yii\helpers\Url;

class LoginFilter extends ActionFilter
{
    /**
     * 方法前执行操作
     * @param \yii\base\Action $action
     * @return bool
     */
    public function beforeAction($action):bool
    {
        if(!parent::beforeAction($action)){
            return false;
        }
        $controller_name= $action->controller->id;
        //不需要登录的控制器
        $noLogin = ['public'];
        if (in_array($controller_name, $noLogin)) {
            return true;
        }

        //是否登录
        if ($this->checkLogin()) {
            return true;
        }
        //跳转登录
        if (Yii::$app->request->isPost || Yii::$app->request->isAjax) {
            Yii::$app->response->data = Result::error('请先登录', 305);
            return false;
        } else {
            Yii::$app->response->redirect(Url::toRoute('/public/login'));
            return false;
        }
    }

    /**
     * 判断登录
     * @return bool
     */
    protected function checkLogin(): bool
    {
        //判断session
        if (LoginAuthHelper::adminLoginInfo('info.id')) {
            return true;
        }

        //判断cookie
        if(Yii::$app->user->isGuest || !Yii::$app->user->id){
            return false;
        }

        //cookie自动登录
        return (new LoginForm())->loginSession(Yii::$app->user->id);
    }
}
