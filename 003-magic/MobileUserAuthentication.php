<?php
    trait MobileUserAuthentication
    {
        public static function authenticate(string $login, string $password)
        {
            return ( $login == "root" && $password == "2" );
        }
    }