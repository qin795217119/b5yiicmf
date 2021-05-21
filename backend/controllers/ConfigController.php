<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use common\cache\ConfigCache;
use common\helpers\commonApi;
use common\models\Config;
use common\services\ConfigService;
use Yii;

/**
 * 参数配置控制器
 * Class ConfigController
 * @package backend\controllers
 */
class ConfigController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->model = Config::class;
        if(Yii::$app->request->isGet && !Yii::$app->request->isAjax){
            Yii::$app->view->params['styleList']=ConfigService::styleList();
            Yii::$app->view->params['groupList']=ConfigService::getConfig('sys_config_group');
        }
    }

    public function actionSite(){
        if(Yii::$app->request->isPost){
            $input = Yii::$app->request->post();
            if (empty($input)) return commonApi::message('无更新数据', false);

            foreach ($input as $id => $value) {
                if($id){
                    $info = Config::findOne($id);
                    if($info){
                        $info->value = $value;
                        $info->save(false);
                    }
                }
            }
            return commonApi::message('保存成功', true);
        }
        $lists=ConfigService::getListByGroup();
        return $this->render('',['lists'=>$lists]);
    }

    public function actionDelcache(){
        ConfigCache::clear();
        return commonApi::message();
    }
}
