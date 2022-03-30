<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\extend\filter;


use backend\extend\helpers\LoginAuthHelper;
use common\helpers\Result;
use yii\base\ActionFilter;
use yii\helpers\Url;
use Yii;

class AuthFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        if(!parent::beforeAction($action)){
            return false;
        }
        $controller_name = $action->controller->id;//控制器名
        $action_name = $action->id;//方法名
        $module_name = $action->controller->module->id;//模块名
        $app_id = \Yii::$app->id;//应用id
        if($app_id == $module_name) $module_name = '';//模块为应用时

        //锁屏判断
        $islock=Yii::$app->session->get('islock');
        $lockPerms = ['common:lockscreen','public:logout'];
        if($islock && !in_array($controller_name.':'.$action_name,$lockPerms)){
            if(Yii::$app->request->isPost || Yii::$app->request->isAjax){
                Yii::$app->response->data = Result::error('锁屏中，无法此操作');
                return false;
            }else{
                Yii::$app->response->redirect(Url::toRoute('/common/lockscreen'));
                return false;
            }
        }


        //权限判断
        $hasPower = LoginAuthHelper::checkPower($module_name,$controller_name,$action_name);
        if(!$hasPower){
            if (Yii::$app->request->isPost || Yii::$app->request->isAjax) {
                Yii::$app->response->data = Result::error('无权访问');
                return false;
            } else {
                Yii::$app->response->redirect(Url::toRoute(['/public/fail','msg'=>'无权访问','code'=>500]));
                return false;
            }
        }
        return true;
    }
}
