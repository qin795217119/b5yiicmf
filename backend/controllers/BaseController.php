<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use backend\helpers\commonAction;
use backend\helpers\CommonBack;
use backend\models\LoginForm;
use common\helpers\AdminExportApi;
use common\helpers\commonApi;
use common\models\Menu;
use yii\db\Expression;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;

/**
 * 后端通用父类
 * Class BaseController
 * @package backend\controllers
 */
class BaseController extends Controller
{
    use commonAction;
    public $model;

    public $view_group='';

    /**
     * 构造函数
     * BaseController constructor.
     */
    public function init()
    {
        parent::init();
        $this->initSystemConst();
    }

    /**
     * 初始化系统常量
     */
    private function initSystemConst()
    {
        if(Yii::$app->request->isGet && !Yii::$app->request->isAjax){
            defined('IS_RENDER') or define('IS_RENDER', true);
        }else{
            defined('IS_RENDER') or define('IS_RENDER', false);
        }
        defined('REQUEST_METHOD') or define('REQUEST_METHOD', strtoupper(Yii::$app->request->method));
        defined('PAGE_LIMIT') or define('PAGE_LIMIT', 10);
        defined('MODULES_NAME') or define('MODULES_NAME', 'backend');
        defined('IMG_URL') or define('IMG_URL',Yii::getAlias('@appweb'));
    }

    /**
     * 定义控制器名和方法名，并分配到视图，登陆检测，权限检测
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if(parent::beforeAction($action)){
            $controller_name=$action->controller->id;
            $action_name=$action->id;
            defined('CONTROLLER_NAME') or define('CONTROLLER_NAME', $controller_name);
            defined('ACTION_NAME') or define('ACTION_NAME', $action_name);
            $notLoginConArr = ['public'];

            //登录判断 会判断cookie
//            if(Yii::$app->user->isGuest && !in_array(strtolower($controller_name),$notLoginConArr)){
//                return $this->bError('请先登录',['public/login']);
//            }

            //登录判断，不判断cookie
            if(!CommonBack::adminLoginInfo('info.id') && !in_array(strtolower($controller_name),$notLoginConArr)){
                Yii::$app->user->logout(true);
                return $this->bError('请先登录',['public/login']);
            }

            //cookie登录判断，YII登录信息有但是自己定义的session中无数据
            $this->cookieLogin();

            //锁屏判断
            $isLock=$this->checkLock();
            if($isLock){
                return $this->bError('锁屏中，无法此操作',['common/lockscreen']);
            }

            //权限判断
            $hasPerms = CommonBack::MenuPowerAuthCheck($controller_name,$action_name);
            if(!$hasPerms){
                return $this->bError('无权访问',['public/noauth']);
            }
            if(Yii::$app->request->isGet && !Yii::$app->request->isAjax){
                Yii::$app->view->params['group']=strtolower(MODULES_NAME);
                Yii::$app->view->params['app']=strtolower(CONTROLLER_NAME);
                Yii::$app->view->params['act']=strtolower(ACTION_NAME);
            }
            return true;
        }
        return false;
    }
    /**
     * 判断锁屏
     * @return bool
     */
    private function checkLock(){
        $islock=Yii::$app->session->get('islock');
        if(!$islock) return false;
        $controller_name = strtolower(CONTROLLER_NAME);
        $action_name = strtolower(ACTION_NAME);
        $permission = 'admin:' . $controller_name . ':' . $action_name;
        if($permission=='admin:common:lockscreen' || $permission=='admin:public:logout'){
            return false;
        }
        return true;
    }

    /**
     * 若开启了cookie登录，则在session缺失时的处理
     * @return bool
     * @throws \Exception
     */
    public function cookieLogin(){
        if(Yii::$app->user->isGuest) return false;
        $adminId=CommonBack::adminLoginInfo('info.id');
        if($adminId && $adminId===Yii::$app->user->getId()){
            return true;
        }
        (new LoginForm())->loginMySession(Yii::$app->user->identity->toArray());
        return true;
    }


    /**
     * beforeAction发生错误时的跳转
     * @param string $msg
     * @param string $url
     * @param int $code
     * @return bool
     */
    public function bError($msg='',$url='',$code=-1){
        $msg=$msg?:"发生错误";
        if(Yii::$app->request->isGet && !Yii::$app->request->isAjax){
            if($url){
                $url=is_array($url)?$url:(array)$url;
            }else{
                $url=[Yii::$app->params['errorPath'],'msg'=>$msg];
            }
            Yii::$app->response->redirect($url);
        }else{
            $url=$url?Url::toRoute($url):'';
            Yii::$app->response->data =commonApi::message($msg,false,[],$code,$url);
        }
        return false;
    }
    /**
     * 跳转到错误页
     * @param string $msg
     * @param int $code
     * @return string
     */
    public function tError(string $msg = "发生错误了", int $code = 400)
    {
        $data = ['msg' => $msg, 'code' => $code];
        return $this->render('/'.Yii::$app->params['errorPath'], $data);
    }

    /**
     * 自动加载视图
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render($view='', $params = [])
    {
        Yii::$app->response->format=\yii\web\Response::FORMAT_HTML;
        if(empty($view)){
            $view=strtolower(ACTION_NAME);
            if($this->view_group){
                $view=$this->view_group.'/'.$view;
            }
        }
        return parent::render($view, $params);
    }
}
