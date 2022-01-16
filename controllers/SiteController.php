<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{
    public static function goHome()
    {
        
        return self::render("home", [
            "name" => "Geralt of Rivii"
        ]);
    }

    public static function goContact()
    {
        return self::render("contact");
    }
}




?>