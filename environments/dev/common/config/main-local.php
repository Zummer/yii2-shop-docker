<?php
return [
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
            'messageConfig' => [
                'from' => ['support_dev@example.com' => 'Shop' . ' robot']
            ],
        ],
    ],
];
