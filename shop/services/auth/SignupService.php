<?php

namespace shop\services\auth;

use shop\entities\User\User;
use shop\repositories\UserRepository;
use shop\forms\auth\SignupForm;
use yii\mail\MailerInterface;

class SignupService
{
    private $mailer;
    private $users;

    public function __construct(MailerInterface $mailer, UserRepository $users)
    {
        $this->mailer = $mailer;
        $this->users = $users;
    }

    public function signup(SignupForm $form): void
    {
        if ($this->users->existsByUsername($form->username)) {
            throw new \DomainException('This username has already been taken.');
        }

        if ($this->users->existsByEmail($form->email)) {
            throw new \DomainException('This email has already been taken.');
        }

        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->users->save($user);

        $sent = $this->mailer
            ->compose(
                ['html' => 'auth/signup/confirm-html', 'text' => 'auth/signup/confirm-text'],
                ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup confirm for ' . \Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }

    }

    public function confirm(string $token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token.');
        }

        $user = $this->users->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->users->save($user);
    }
}
