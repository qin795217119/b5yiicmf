<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'layout'=>false,
    'components' => [
        //禁用自带所有资源
        'assetManager' => [
            'bundles'=>false
        ],
        'request' => [
            'enableCsrfValidation'=>false,
            'cookieValidationKey' => 'api.application.www.b5net.com',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
//                $response = $event->sender;
//                if($response->statusCode !=200){
//                    $response->data = [
//                        'code' => $response->statusCode,
//                        'success' => false,
//                        'msg' => $response->statusText,
//                        'data' => (Object)[],
//                    ];
//                }
//                $response->statusCode = 200;
//                $response->format = \yii\web\Response::FORMAT_JSON;
            },
        ],
//        'urlManager' => [
//            'enablePrettyUrl' => true,
//            'showScriptName' => false,
//            'enableStrictParsing' => false,
//            'rules' => [
//
//            ],
//        ]

    ],
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ]
    ],
    'params' => $params,
];
