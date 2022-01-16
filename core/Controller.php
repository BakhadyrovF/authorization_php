<?php

namespace app\core;



class Controller 
{

    public static function render($view, $params = [], $layout = "main")
    {
        return Application::$app->router->render($view, $layout, $params);
    }

    public function getLogOut()
    {
        return Application::$app->logout();
    }


    
}


?>