<?php

namespace frontend\services\auth;

use common\entities\User;
use frontend\forms\SignupForm;
use yii\mail\MailerInterface;

class SignupService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function signup(SignupForm $form): void
    {
        if (User::find()->andWhere(['username' => $form->username])->one()) {
            throw new \DomainException('This username has already been taken.');
        }

        if (User::find()->andWhere(['email' => $form->email])->one()) {
            throw new \DomainException('This email has already been taken.');
        }

        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        if(!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }

        $sent = $this->mailer
            ->compose(
                ['html' => 'emailConfirmToken-html', 'text' => 'emailConfirmToken-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup confirm for ' . \Yii::$app->name)
            ->send();
        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }

    }

    public function confirm(string $token)
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }

        /* @var $user User */
        $user = User::findOne(['email_confirm_token' => $token]);

        if (!$user) {
            throw new \DomainException('User is not found.');
        }

        $user->confirmSignup();

        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }
}