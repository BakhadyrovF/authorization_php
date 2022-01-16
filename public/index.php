<?php

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
use app\models\User;

require_once __DIR__ . "/../vendor/autoload.php";

$config = [
    "class" => User::class
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get("/", [SiteController::class, "goHome"]);

$app->router->get("/contact", [SiteController::class, "goContact"]);

$app->router->get("/register", [new AuthController(), "register"]);

$app->router->post("/register", [new AuthController(), "register"]);

$app->router->get("/login", [new AuthController(), "login"]);

$app->router->post("/login", [new AuthController(), "login"]);

$app->router->get("/logout", [new AuthController(), "logout"]);

$app->router->get("/profile", [new AuthController(), "profile"]);

echo $app->run();


?>