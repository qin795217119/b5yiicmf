<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=b5yii2cmf',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8mb4',

//            'enableSchemaCache' => true,
//
//            // Duration of schema cache.
//            'schemaCacheDuration' => 3600,
//
//            // Name of the cache component used to store schema information
//            'schemaCache' => 'cache',
        ],
    ],
];
