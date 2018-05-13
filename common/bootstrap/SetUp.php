<?php
namespace common\bootstrap;

use Yii;
use frontend\services\auth\PasswordResetService;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // TODO: Implement bootstrap() method.

        $container = \Yii::$container;

        $container->setSingleton(PasswordResetService::class, [], [
            [Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot']
        ]);
    }
}