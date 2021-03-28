<?php

$config = [
    'layout'=>'layout',
    'defaultRoute' => 'index',
    'runtimePath' => '@approot/runtime',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'mPMN3JUvLg6zFbz6abd5MmBuBtI9jE1C',
        ],
        'assetManager' => [
            'basePath' => '@approot/public/assets/admin',
            'baseUrl' => '@appweb/public/assets/admin',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js'=>[],
                    'sourcePath' => null,
                ],
                'yii\web\YiiAsset' => [
                    'js' => [],  // 去除 yii.js
                    'sourcePath' => null,  // 防止在 frontend/web/asset 下生产文件
                ],
                'yii\widgets\ActiveFormAsset' => [
                    'js' => [],  // 去除 yii.activeForm.js
                    'sourcePath' => null,  // 防止在 frontend/web/asset 下生产文件
                ],
                'yii\validators\ValidationAsset' => [
                    'js' => [],  // 去除 yii.validation.js
                    'sourcePath' => null,  // 防止在 frontend/web/asset 下生产文件
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],  // 去除 bootstrap.css
                    'sourcePath' => null, // 防止在 frontend/web/asset 下生产文件
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [],  // 去除 bootstrap.js
                    'sourcePath' => null,  // 防止在 frontend/web/asset 下生产文件
                ],
            ],
        ],
    ]
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
