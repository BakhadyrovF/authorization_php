<?php

namespace app\core;



abstract class DbModel extends Model
{
    abstract protected function getAttributes();


    public function save()
    {
        $tableName = "users";
        $attributes = implode(", ", $this->getAttributes());
        $values = implode(", ", array_map(fn($a) => ":$a", $this->getAttributes()));
        $statement = $this->prepare("INSERT INTO $tableName ($attributes) VALUES ($values)");
        
        foreach($this->getAttributes() as $attribute)
        {
            $statement->bindValue(":$attribute", $this->hashPassword($attribute, $this->{$attribute}));
        }
        $statement->execute();

    }

    protected static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    protected function hashPassword($attribute, $value)
    {
        return ($attribute === "password") ? password_hash($value, PASSWORD_BCRYPT) : $value;
        
    }

    public static function findOne($data)
    {
        $attributes = implode(", ", array_keys($data));
        $tableName = "users";
        $statement = self::prepare("SELECT * FROM $tableName WHERE $attributes = :$attributes");
        foreach($data as $attribute => $value)
        {
            $statement->bindValue(":$attribute", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
        
        
    }
}




?>