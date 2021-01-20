<?php

class swHttp
{
    // sw http server
    private $_http;
    // yii2 application
    private $_app;

    // 程序启动入口
    public function run($conf, $app)
    {
        $this->_app = $app;
        $this->_http = new swoole_http_server('0.0.0.0', 9502);
        $this->_http->on('request', [$this, 'onRequest']);
        $this->_http->set($conf);
        $this->_http->start();
    }
    // sw http onRequest回调函数
    public function onRequest($request, $response)
    {
        $this->setAppRunEnv($request, $response);
        $this->_app->run();
    }

    // 模拟fpm功能
    public function setAppRunEnv($request, $response)
    {

                // Yii2 request组件保存$request
        Yii::$app->request->setSwRequest($request);
        // Yii2 response组件保存$response
        Yii::$app->response->setSwResponse($response);

        // 常驻服务需要清除信息
        Yii::$app->request->getHeaders()->removeAll();
        Yii::$app->response->clear();

        // 常驻服务需要清除信息
        foreach ($request->server as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;
        }

        // 设置头信息
        foreach ($request->header as $name => $value) {
            Yii::$app->request->getHeaders()->set($name, $value);
        }
        // 设置请求参数
        Yii::$app->request->setQueryParams($request->get);
        Yii::$app->request->setBodyParams($request->post);
        $rawContent = $request->rawContent() ?: null;
        Yii::$app->request->setRawBody($rawContent);
        // 设置路由
        Yii::$app->request->setPathInfo($request->server['path_info']);
    }
}
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

$app=new \yii\web\Application($config);
$swConf = [
    'pid_file'      => __DIR__ . '/server.pid',
    'worker_num'    => 4,
    'max_request'   => 1,
    'daemonize'     => 0,
];

(new swHttp())->run($swConf, $app);
//(new yii\web\Application($config))->run();
