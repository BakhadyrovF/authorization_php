<?php

namespace app\core;

use app\models\Login;
use app\models\User;

abstract class Model
{
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_MATCH = "match";
    public const RULE_UNIQUE = "unique";
    public const RULE_INVALID_EMAIL = "invalid_mail";
    public const RULE_INCORRECT = "incorrect";
    public array $errors = [];
 

     


    public function loadData($data, object $object)
    {
        $object = new $object();
        foreach($data as $key => $value)
        {
            if(property_exists($object, $key))
            {
                $this->{$key} = $value;
            }
        }

        

        
    }

    abstract public function rules();
    abstract static protected function prepare($sql);

   

    public function validate()
    {
        foreach($this->rules() as $attribute => $rules)
        {
            $value = $this->{$attribute};
            foreach($rules as $rule)
            {
                $ruleName = $rule;
                if(!is_string($ruleName))
                {
                    $ruleName = $rule[0];
                }

                if($ruleName === self::RULE_REQUIRED && empty($value))
                {
                    $this->addErrors($attribute, self::RULE_REQUIRED);
                }

                if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL))
                {
                    $this->addErrors($attribute, self::RULE_EMAIL);
                }

                if($ruleName === self::RULE_MIN && strlen($value) < 8)
                {
                    $this->addErrors($attribute, self::RULE_MIN, $rule);
                }

                if($ruleName === self::RULE_MAX && strlen($value) > $rule["max"])
                {
                    $this->addErrors($attribute, self::RULE_MAX, $rule);
                }

                if($ruleName === self::RULE_MATCH && $value !== $this->password)
                {
                    $this->addErrors($attribute, self::RULE_MATCH);
                }

                if($ruleName === self::RULE_UNIQUE)
                {
                    $tableName = "users";
                    $statement = Application::$app->db->pdo->prepare("SELECT * FROM $tableName WHERE $attribute = :$attribute");
                    $statement->bindValue(":$attribute", $this->{$attribute});
                    $statement->execute();
                    $user = $statement->fetchObject();
                    if($user)
                    {
                        $this->addErrors($attribute, self::RULE_UNIQUE);
                    }
                   
                }

                

            }
        }

        
      
        return empty($this->errors);
    }

    public function addErrors($attribute, $ruleName, $params = [])
    {
        $message = $this->errorMessages()[$ruleName];
        foreach($params as $key => $value)
        {
            $message = str_replace("{{$key}}", $value, $message);
        }   

        $this->errors[$attribute][] = $message;
    }

    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => "This field is required!",
            self::RULE_EMAIL => "This Email is invalid!",
            self::RULE_MIN => "This field length must be minimum {min}!",
            self::RULE_MAX => "This field length must be maximum {max}!",
            self::RULE_MATCH => "This field must be same as Password!",
            self::RULE_UNIQUE => "This Email is already exist!",
            self::RULE_INVALID_EMAIL => "This Email does not exist!",
            self::RULE_INCORRECT => "This Password is incorrect!"
            
            

        ];
    }

    public function getData($attribute)
    {
        return $this->{$attribute};
    }

    

}





?>