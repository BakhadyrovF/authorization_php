<?php

namespace app\core;




class Request
{
    public function getMethod()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function getPath()
    {
        $path = $_SERVER["REQUEST_URI"];
        $position = strpos($path, "?");
        if($position)
        {
            return substr($path, 0, $position);
        }
        return $path;
    }

    public function getBody()
    {
        return $_POST;
    }

    public function redirect($url)
    {
        header("Location: $url");
    }
}





?>