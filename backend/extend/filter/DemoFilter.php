<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types=1);

namespace backend\extend\filter;

use backend\extend\helpers\LoginAuthHelper;
use common\cache\ConfigCache;
use common\helpers\Result;
use yii\base\ActionFilter;
use Yii;

class DemoFilter extends ActionFilter
{
    public function beforeAction($action)
    {
        if(!parent::beforeAction($action)){
            return false;
        }
        $controller_name = $action->controller->id;//控制器名
        $action_name = $action->id;//方法名
        $notAuthController = ['public'];
        $notAuthAction = ['tree','lockscreen'];

        if (in_array($controller_name, $notAuthController) || in_array($action_name, $notAuthAction) || substr($action_name,0,4) === 'ajax') {
            return true;
        }
        $noCheckAction = ['index'];
        if((Yii::$app->request->isPost || Yii::$app->request->isAjax) && !in_array($action_name,$noCheckAction)){
            $model = ConfigCache::get('demo_mode');
            $admin_id = LoginAuthHelper::adminLoginInfo('info.id');
            $root_id = intval(Yii::$app->params['root_admin_id']);
            if($model == '1' && $admin_id!=$root_id){
                Yii::$app->response->data = Result::error('演示中，无法此操作');
                return false;
            }
        }
        return true;
    }
}
