<?php


namespace app\core;


class Database
{
    public \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO("mysql:host=localhost;port=3306;dbname=mvc_01", "root", "");
    }

    
}




?>