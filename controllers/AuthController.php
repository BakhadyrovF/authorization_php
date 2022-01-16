<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\Login;
use app\models\User;

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        $login = new Login();

        if($request->getMethod() === "post")
        {
            $login->loadData($request->getBody(), $login);
            if($login->validate() && $login->loginValidate())
            {
                
                $request->redirect("/profile");
                exit;
            }

        }

        return self::render("login", [
            "model" => $login
        ], "auth");
    }
    
    public function register(Request $request)
    {
        $user = new User();
        $login = new Login();
      
        if($request->getMethod() === "post")
        {
            $user->loadData($request->getBody(), $user);

            if($user->validate())
            {
                $user->save();
                $request->redirect("/");
                exit;
            }
            
        }

        return self::render("register", [
            "model" => $user
        ], "auth");


    }

    public function logout(Request $request)
    {
        $this->getLogOut();
        $request->redirect("/");
        exit;
        
    }

    public function profile(Request $request)
    {
        $login = new Login();
        if(Application::$app->isGuest())
        {
            $request->redirect("login");
            exit;
        }

        return self::render("/profile", [
            "model" => $login
        ]);
       

        
        
        
    }


}



?>