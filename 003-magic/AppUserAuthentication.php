<?php
    trait AppUserAuthentication
    {
        public static function authenticate(string $login, string $password)
        {
            return ( $login == "admin" && $password == "1" );
        }
    }