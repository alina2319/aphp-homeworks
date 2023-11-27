<?php
    spl_autoload_register(function ($trait) { include $trait.'.php'; });

    class Example
    {
        public function auth(string $login, string $password)
        {
            echo AppUserAuthentication::authenticate($login, $password) ? "User authenticated in App!" :
                 ( MobileUserAuthentication::authenticate($login, $password) ? "User authenticated in mobile App!" :
                 "User not authenticated!" );
        }
    }

    $ex = new Example();
    
    // admin 1 - авторизация в APP
    // root 2 - авторизация в Mobile App


    
    //$ex->auth("admin", "1");
    //$ex->auth("root", "2");
    $ex->auth("father", "123");
