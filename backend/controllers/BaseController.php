<?php
// +----------------------------------------------------------------------
// | B5YiiCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace backend\controllers;

use backend\helpers\CommonBack;
use backend\models\LoginForm;
use common\helpers\AdminExportApi;
use common\helpers\commonApi;
use common\models\Menu;
use moonland\phpexcel\Excel;
use yii\db\Expression;
use yii\helpers\FileHelper;
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
    public string $model;

    public string $view_group='';

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

            //登录判断
            $notLoginConArr = ['public'];
            if(Yii::$app->user->isGuest && !in_array(strtolower($controller_name),$notLoginConArr)){
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
            $hasPerms = $this->checkAuth();
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
     * 权限检测
     * @return bool
     * @throws \Exception
     */
    public function checkAuth()
    {
        $adminId=Yii::$app->user->getId();
        if ($adminId==1) return true;
        //检测权限
        $controller_name = strtolower(CONTROLLER_NAME);
        $action_name = strtolower(ACTION_NAME);
        $permission = 'admin:' . $controller_name . ':' . $action_name;

        //不走授权的控制器及、方法及节点
        $notAuthController = ['public', 'common'];
        $notAuthAction = ['tree'];
        $notAuthPermission=['admin:index:index','admin:index:home'];
        if (in_array($controller_name, $notAuthController) || in_array($action_name, $notAuthAction) || in_array($permission,$notAuthPermission)) {
            return true;
        }

        //获取登录时的授权菜单Id
        $menuList = CommonBack::adminLoginInfo('menu');
        if (empty($menuList)) {
            return false;
        }

        //获取节点信息
        $menuInfo = Menu::findOne(['perms' => $permission]);
        //节点不存在或禁用
        if (!$menuInfo || !$menuInfo['status']) return false;

        if (in_array($menuInfo['id'], $menuList)) return true;
        return false;
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
     * 首页
     */
    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            // 获取参数
            $argList = func_get_args();
            $pageList = $argList[0]??true;
            $extMap = $argList[1]??[];
            $extSort = $argList[2]??[];

            $map = [];
            $order_column = 'id';
            $order_sort = 'asc';
            $pageNum = 1;
            $pageSize = defined('PAGE_LIMIT') ? PAGE_LIMIT : 10;
            $total = 0;

            $param = \Yii::$app->request->post();
            if ($param) {
                //表单的条件 where 的条件
                if (!empty($param['where']) && is_array($param['where'])) {
                    foreach ($param['where'] as $paramField => $paramValue) {
                        $paramValue = trim($paramValue);
                        if ($paramValue !== '') {
                            $map[] = [$paramField => $paramValue];
                        }
                    }
                }
                //表单的条件 like 的条件
                if (!empty($param['like']) && is_array($param['like'])) {
                    foreach ($param['like'] as $paramField => $paramValue) {
                        $paramValue = trim($paramValue);
                        if ($paramValue !== '') {
                            $map[] = ['like', $paramField, $paramValue];
                        }
                    }
                }
                //表单的条件 between 的条件
                if (!empty($param['between']) && is_array($param['between'])) {
                    foreach ($param['between'] as $paramField => $paramValue) {
                        if (is_array($paramValue) && count($paramValue) > 1) {
                            $start = $paramValue['start'];
                            $end = $paramValue['end'];
                            if ($start || $end) {
                                if ($start && $end) {
                                    $map[] = ['between', $paramField, $start, $end];
                                } elseif ($start) {
                                    $map[] = ['>', $paramField, $start];
                                } elseif ($end) {
                                    $map[] = ['<', $paramField, $end];
                                }
                            }
                        }
                    }
                }
                //表单的条件 findinset 的条件
                if (!empty($param['findinset']) && is_array($param['findinset'])) {
                    foreach ($param['findinset'] as $paramField => $paramValue) {
                        $paramValue = trim($paramValue);
                        if ($paramValue !== '') {
                            $map[] = [$paramField ,'findinset', $paramValue];
                        }
                    }
                }
                //排序条件
                if (!empty($param['orderByColumn'])) {
                    $order_column = trim($param['orderByColumn']);
                }
                if (!empty($param['isAsc'])) {
                    $order_sort = trim($param['isAsc']);
                }
                // 分页条件
                if (!empty($param['pageNum'])) $pageNum = intval($param['pageNum']);
                if (!empty($param['pageSize'])) $pageSize = intval($param['pageSize']);
            }

            if ($extMap) { // 查询条件合并
                $map = array_merge($map, $extMap);
            }

            $extSort = $extSort ?: [[$order_column, $order_sort]];// 指定排序

            $offset = ($pageNum - 1) * $pageSize; //分页开始

            //拼接sql
            $query = $this->model::find()->where('1');
            if (!empty($map)) {
                $query = $this->bWhereFilter($query, $map);
            }
            //若开启了分页获取总数
            if ($pageList) {
                $total = $query->count();
            }
            if (!empty($select)) { //指定查询字段
                $query = $query->select($select);
            }
            if ($pageList) { //指定分页
                $query = $query->offset($offset)->limit($pageSize);
            }
            if (!empty($extSort)) { // 指定排序
                $orderBy = [];
                foreach ($extSort as $key => $val) {
                    if (is_array($val)) {
                        $orderBy[] = $val[0] . ' ' . $val[1];
                    } else {
                        $orderBy[] = $key . ' ' . $val;
                    }
                }
                $orderBy = implode(',', $orderBy);
                $query = $query->orderBy($orderBy);
            }


            //导出判断
            $export = $param['isExport']??'0';
            if($export){
                $list = $query->all();
                $exportData = $this->handelExport($list);
                return AdminExportApi::run(new $this->model(),$exportData);
            }else{
                $list = $query->asArray()->all();
            }

            if (!$pageList) {
                $total = count($list);
            }
            return commonApi::message('操作成功', true, $list, 0, '', ['total' => (int)$total]);
        } else {
            $data = Yii::$app->request->get();
            return $this->render('', ['input' => $data]);
        }
    }
    protected function handelExport($list,$columns=[],$headers=[]){
        return ['list'=>$list,'columns'=>$columns,'headers'=>$headers];
    }
    /**
     * 公共添加页
     */
    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {
            $argList = func_get_args();
            $data = $argList[0] ?? [];
            if (!$data) {
                $data = Yii::$app->request->post();
            }
            if ($data) {
                $model = new $this->model();
                if (!$model->load($data, '')) {
                    return commonApi::message('无提交数据', false);
                }
                if (!$model->validate()) {
                    return commonApi::message(commonApi::getModelError($model), false);
                }
                $result = $model->save(false);
                if ($result) {
                   return commonApi::message('添加成功', true);
                } else {
                    return commonApi::message( '添加失败', false);
                }
            }
            return commonApi::message('无提交数据', false);
        } else {
            $data = Yii::$app->request->get();
            return $this->render('', ['input' => $data]);
        }
    }
    /**
     * 公共编辑页
     */
    public function actionEdit()
    {
        if (Yii::$app->request->isPost) {
            $argList = func_get_args();
            $data = $argList[0] ?? [];
            if (!$data) {
                $data = Yii::$app->request->post();
            }
            if ($data) {
                if (!isset($data['id']) || !$data['id']) {
                    return commonApi::message('缺少主键参数', false);
                }
                $model = $this->model::findOne($data['id']);
                if (!$model) {
                    return commonApi::message('信息不存在', false);
                }
                if (!$model->load($data, '')) {
                    return commonApi::message('无提交数据', false);
                }
                if (!$model->validate()) {
                    return commonApi::message(commonApi::getModelError($model), false);
                }
                $result = $model->save(false);
                if ($result !== false) {
                    return commonApi::message('保存成功', true);
                } else {
                    return commonApi::message('保存失败', false);
                }
            }
            return commonApi::message('无提交数据', false);
        }
        $info = [];
        $data = Yii::$app->request->get();
        if (isset($data['id']) && $data['id']) {
            $info = $this->model::findOne($data['id']);
        }
        if (empty($info)) {
            return $this->tError('参数或信息错误');
        }
        return $this->render('', ['info' => $info, 'input' => $data]);
    }
    /**
     * 公共删除
     */
    public function actionDrop()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        $field = $argList[1] ?? '';
        $url = $argList[2]??'';
        if (empty($data)) {
            $data = Yii::$app->request->post();
        }
        $field = $field?: 'id';
        $id = intval($data['id']??0);
        if($id<1){
            return commonApi::message('参数错误', false);
        }
        $info = $this->model::findOne([$field=>$id]);
        if(!$info){
            return commonApi::message('信息不存在或已删除', false);
        }
        $result = $info->delete();
        if ($result) {
            return commonApi::message('删除成功', true, [], null, $url);
        }
        return commonApi::message('删除失败', false);
    }

    /**
     * 批量删除
     * @return array
     */
    public function actionDropall()
    {
        $argList = func_get_args();

        $data = $argList[0] ?? [];
        $field = $argList[1] ?? '';
        $url = $argList[2]??'';
        if (empty($data)) {
            $data = Yii::$app->request->post();
        }

        $field = $field?: 'id';
        $idArr=[];
        if($data && isset($data['ids'])){
            $ids = $data['ids'];
            if (!is_array($ids)) {
                $ids = trim($ids, ',');
                $ids = explode(',', $ids);
            }
            foreach ($ids as $id){
                if($id && !in_array($id,$idArr)){
                    $idArr[]=$id;
                }
            }
        }
        if (empty($idArr)) {
            return commonApi::message('未选择数据', false);
        }
        if (count($idArr) ==1) {
            $idArr = $idArr[0];
        }
        $result = $this->model::deleteAll([$field => $idArr]);
        if ($result) {
            return commonApi::message('删除成功', true, [], null, $url);
        }
        return commonApi::message('删除失败', false);
    }
    /**
     * 设置记录状态
     * @return mixed
     */
    public function actionSetstatus()
    {
        $argList = func_get_args();
        $data = $argList[0] ?? [];
        if (!$data) {
            $data = Yii::$app->request->post();
        }
        if (!$data) return commonApi::message('参数错误', false);
        if (empty($data['id'])) {
            return commonApi::message('未选择数据', false);
        }
        if (!isset($data['status'])) {
            return commonApi::message('状态参数错误', false);
        }

        $update = ['id' => $data['id'], 'status' => $data['status']];
        $info = $this->model::findOne($data['id']);
        if(!$info){
            return commonApi::message('信息不存在', false);
        }
        $info->status = $data['status'];
        $result = $info->save(false);
        $title = $data['status'] ? '启用' : '停用';
        if ($result) {
            return commonApi::message($title.'成功', true);
        }
        return commonApi::message($title . '失败', false);
    }
    /**
     * 处理自定义数组where条件
     * @param $query
     * @param $map
     * @return mixed
     */
    public function bWhereFilter($query, $map)
    {
        if (empty($map)) return $query;
        if (is_array($map)) {
            foreach ($map as $key => $val) {
                if (is_array($val)) {
                    if (count($val) == 3) {
                        if ($val[1] === 'findinset') {
                            $val = new Expression('FIND_IN_SET("' . $val[2] . '", ' . $val[0] . ')');
                        } elseif ($val[1] === 'in') {
                            $val = [$val[0] => $val[2]];
                        } elseif ($val[1] === '=') {
                            $val = [$val[0] => $val[2]];
                        }
                    }
                    $query = $query->andWhere($val);
                } else {
                    $query = $query->andWhere([$key => $val]);
                }

            }
        } else {
            $query = $query->andWhere($map);
        }
        return $query;
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
