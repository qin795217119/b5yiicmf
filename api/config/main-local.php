<?php

$config = [
    'runtimePath' => '@approot/runtime',
];
//if(defined('SWOOLE_REQ') && SWOOLE_REQ){
//    $config['components']['response']=[
////        'class'  => \api\components\Response::class,
//        'format' => \yii\web\Response::FORMAT_JSON,
//    ];
//}

return $config;
