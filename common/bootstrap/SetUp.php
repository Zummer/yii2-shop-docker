<?php

namespace common\bootstrap;

use frontend\services\contact\ContactService;
use frontend\services\auth\PasswordResetService;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // TODO: Implement bootstrap() method.

        $container = \Yii::$container;

        $container->setSingleton(PasswordResetService::class, [], [
            [$app->params['supportEmail'] => $app->name . ' robot']
        ]);

        $container->setSingleton(ContactService::class, [], [
            [$app->params['supportEmail'] => $app->name . ' robot'],
            [$app->params['adminEmail'] => $app->name . ' admin'],
        ]);
    }
}