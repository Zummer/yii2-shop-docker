<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'useMemcached' => true, // <--- here
            /* можно не указывать сервер, и тогда будет создан новый 127.0.0.1:11211, он же memcached_server:11211
             'servers' => [
                [
                    'host' => 'memcached_server',
                    'port' => 11211,
                ],
            ],
            */
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv('DB_DSN'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset' => 'utf8',
        ],
    ],
];
