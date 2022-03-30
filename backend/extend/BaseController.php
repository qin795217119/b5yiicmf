<?php
// +----------------------------------------------------------------------
// | B5Yii2CMF V3.0 [快捷通用基础管理开发平台]
// +----------------------------------------------------------------------
// | Author: 冰舞 <357145480@qq.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace backend\extend;

use common\cache\ConfigCache;
use common\helpers\Result;
use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * 应用实例
     * @var \yii\web\Application
     */
    protected $app;

    /**
     * 视图文件夹，对视图进行分组
     * @var string
     */
    public $view_group = '';

    /**
     * 构造函数
     * BaseController constructor.
     */
    public function init()
    {
        parent::init();
        $this->app = \Yii::$app;

        if($this->request->isGet || !$this->request->isAjax){
            $this->app->view->params['system_name'] = ConfigCache::get('sys_config_sysname');
        }
    }

    /**
     * 行为过滤
     * @return array
     */
    public function behaviors():array
    {
        return [
            //登录判断
            ['class' => \backend\extend\filter\LoginFilter::class],
            //权限判断
            ['class' => \backend\extend\filter\AuthFilter::class],
            //演示操作判断
            ['class' => \backend\extend\filter\DemoFilter::class],
        ];
    }

    /**
     * 跳转到错误页或错误json
     * @param string $msg
     * @param int $code
     * @return array|string
     */
    public function error(string $msg='',int $code = 500){
        $msg = $msg?:'发生错误了';
        $this->app->response->setStatusCode(200);// //异常也可以显示信息
        if($this->request->isAjax){
            return Result::error($msg,$code);
        }else{
            return $this->render('@backend/views/public/fail',['msg'=>$msg,'code'=>$code]);
        }
    }

    /**
     * 跳转成功
     * @param string $msg
     * @param array $data
     * @param array $extend
     * @return array|string
     */
    public function success(string $msg = '', array $data = [], array $extend = []){
        $msg = $msg?:'操作成功';
        if($this->request->isAjax){
            return Result::success($msg,$data,$extend);
        }else{
            return $this->render('@backend/views/public/success',['msg'=>$msg,'code'=>200]);
        }
    }

    /**
     * 重写渲染
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render($view ='', $params = [])
    {
        return parent::render($this->genView($view), $params);
    }

    /**
     * 重写渲染
     * @param string $view
     * @param array $params
     * @return string
     */
    public function renderPartial($view = '', $params = [])
    {
        return parent::renderPartial($this->genView($view), $params);
    }

    /**
     * 生成视图地址
     * @param string $view
     * @return string
     */
    private function genView(string $view = ''):string{
        if (!$view) {
            $view = $this->action->id;
            if ($this->view_group) {
                $view = $this->view_group . '/' . $view;
            }
        }
        return $view;
    }
}
