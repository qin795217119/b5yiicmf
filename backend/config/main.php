<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'system' => [
            'class' => 'backend\modules\system\Module',
        ],
        'demo' => [
            'class' => 'backend\modules\demo\Module',
        ],
    ],
    'layout'=>'layout',
    'defaultRoute' => 'index',
    'components' => [
        //禁用自带所有资源
        'assetManager' => [
            'bundles'=>false
        ],
        'request' => [
            //'enableCsrfCookie' => false, //当使用ie11以下或者前端无法使用cookie时
            'csrfParam' => 'b5yii2cmf',
            'cookieValidationKey' => 'b5yii2cmf-app-backend',
        ],
        'user' => [
            'identityClass' => 'backend\extend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'b5yii2cmf-app-backend',
//            'class' => 'yii\redis\Session',
//            //若common中的redis组件配置了，可以省略下面的配置
//            'redis' => [
//                'hostname' => '127.0.0.1',
//                'port' => 6379,
//                'password' => '123456',
//                'database' => 2
//            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => '/public/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
