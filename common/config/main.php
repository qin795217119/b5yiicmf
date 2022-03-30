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
            'viewPath' => '@common/mail',
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
    ],
];
