<?php

namespace frontend\services\auth;

use common\entities\User;
use frontend\forms\SignupForm;

class SignupService
{
    public function signup(SignupForm $form): User
    {
        if (User::find()->andWhere(['username' => $form->username])->one()) {
            throw new \DomainException('This username has already been taken.');
        }

        if (User::find()->andWhere(['email' => $form->email])->one()) {
            throw new \DomainException('This email has already been taken.');
        }

        $user = User::signup(
            $form->username,
            $form->email,
            $form->password
        );

        if(!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }

        return $user;

    }
}