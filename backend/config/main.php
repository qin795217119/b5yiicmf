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
