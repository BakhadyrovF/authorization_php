<?php

namespace app\core;



class Router
{
    public Request $request;
    public array $routes = [];


    public function __construct(Request $request)
    {
        $this->request = $request;
        
        
    }

    public function get($path, $callback)
    {
        $this->routes["get"][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes["post"][$path] = $callback;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        $callback = $this->routes[$method][$path] ?? false;
        if(!$callback)
        {
            return $this->render("_404", "main");
        }

        

        
        return call_user_func($callback, $this->request);
        

    }

    public function render($view, $layout, $params = [])
    {
        $layoutContent = $this->renderLayout($layout);
        $viewContent = $this->renderView($view, $params);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    public function renderView($view, $params)
    {
        foreach($params as $key => $value)
        {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

    public function renderLayout($layout)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }



}




?>