<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset'
    ],
    'timeZone' => 'Asia/Shanghai',
    'language'=>'zh-CN',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => ['queue'],//将queue组件注册到控制台
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'password' => '123456',
            'database' => 0,
        ],
        'queue'=>[
            'class' => \yii\queue\redis\Queue::class,
            'redis' => 'redis',
            'as log' => \yii\queue\LogBehavior::class,
            'channel' => 'b5queue'
        ]
    ],
];
