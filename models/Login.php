<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;


class Login extends DbModel
{
    public string $email = "";
    public string $password = "";

    public function getAttributes()
    {
        return ["email", "password"];
    }

    public function rules()
    {
        return [
            "email" => [self::RULE_REQUIRED, [self::RULE_EMAIL], [self::RULE_INVALID_EMAIL]],
            "password" => [self::RULE_REQUIRED, [self::RULE_INCORRECT]]
        ];
    }

    public function loginValidate()
    {
        $user = User::findOne(["email" => $this->email]);
        if(!$user)
        {
            $this->addErrors("email", self::RULE_INVALID_EMAIL);
            return false;
        }

        if(!password_verify($this->password, $user->password))
        {
            $this->addErrors("password", self::RULE_INCORRECT);
            return false;
        }
        
        return Application::$app->login($user);
    }


}























?>