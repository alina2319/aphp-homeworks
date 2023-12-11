<?php

namespace Objects\Traits;

trait TMobileUserAuth
{
    private string $loginMobile = 'Иван';
    private string $passwordMobile = '2222';

    public function authenticate(string $userName, string $userPassword) {
        if ($this->loginMobile === $userName && $this->passwordMobile === $userPassword) {
            echo $this->loginMobile . ' - пользователь мобильного приложения' . PHP_EOL;
        } else {
            echo 'Введён неправильный логин/пароль мобильного приложения'. PHP_EOL . 'Введите новые значения';
        }
    }
}