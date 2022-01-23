<?php


namespace app\core;


class Database
{
    public \PDO $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO("mysql:host=localhost;port=3306;dbname=mvc_01", "root", "");
        $this->createTable();
    }

    public function createTable()
    {
        $statement = $this->pdo->prepare("CREATE TABLE IF NOT EXISTS users 
        (id INT PRIMARY KEY AUTO_INCREMENT, firstname VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL, lastname VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL)");
        $statement->execute();
    }

    
}




?>