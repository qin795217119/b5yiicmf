<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    //将所有的应用放到统一的地方，达到缓存共享等作用
    'runtimePath' => '@common/runtime',
    'timeZone' => 'Asia/Shanghai',
    'language'=>'zh-CN',
//    'bootstrap' => ['queue'],//将queue组件注册到控制台
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        //定义邮箱配置
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/extend/mail',
        ],
        //对于数据格式的验证
        'formatter'=>[
            'dateFormat'=>'yyyy-MM-dd',
            'datetimeFormat'=>'yyyy-MM-dd HH:mm:ss',
            'timeFormat'=>'HH:mm:ss',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
//        'cache' => [
//            'class' => 'yii\redis\Cache',
//             //若下面的redis组件配置了，可以省略下面的配置
//            'redis' => [
//                'hostname' => '127.0.0.1',
//                'port' => 6379,
//                'password' => '123456',
//                'database' => 0,
//            ]
//        ],
//
//        'redis' => [
//            'class' => 'yii\redis\Connection',
//            'hostname' => '127.0.0.1',
//            'port' => 6379,
//            'password' => '123456',
//            'database' => 1,
//        ],
//
//        'queue'=>[
//            'class' => \yii\queue\redis\Queue::class,
//            'redis' => 'redis',
//            'as log' => \yii\queue\LogBehavior::class,
//            'channel' => 'b5queue'
//        ]

    ],
];
