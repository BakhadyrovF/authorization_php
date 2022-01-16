<?php

namespace app\core;

use app\core\form\Field;
use app\models\Login;
use app\models\User;

class Application 
{
    public static Application $app;
    public static $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Controller $controller;
    public Database $db;
    public Login $login;
    public Session $session;
    public ?DbModel $user;
    public $class;

    
    public function __construct($rootPath, $config)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->login = new Login();
        $this->session = new Session();
        $this->controller = new Controller();
        $this->router = new Router($this->request);
        $this->db = new Database();
        $this->class = $config["class"];
        

        
        $primaryValue = $this->session->get("user");
        if($primaryValue)
        {
            $primaryKey = "id";
            $this->user = $this->class::findOne([$primaryKey => $primaryValue]);
        }else
        {
            $this->user = null;
        }
        
    }

    public function run()
    {
        return $this->router->resolve();
    }

    public function login($user)
    {
        $this->user = $user;
        $primaryKey = "id";
        $primaryValue = $this->user->id;
        $this->session->set("user", $primaryValue);
        return true;
        
    }

    public function logout()
    {
        $this->session->remove("user");
        $this->user = null;
        
    }

    public function isGuest()
    {
        return !$this->user;
    }
}



?>