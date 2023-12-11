<?php
namespace Objects\Traits;
trait TAppUserAuth
{
    private string $loginApp = 'Олег';
    private string $passwordApp = '1111';

    public function authenticate(string $userName, string $userPassword) {
        if ($this->loginApp === $userName && $this->passwordApp === $userPassword) {
            echo $this->loginApp . ' - пользователь приложения'. PHP_EOL;
        } else {
            echo 'Введён неправильный логин/пароль приложения'. PHP_EOL . 'Введите новые значения'. PHP_EOL;
        }
    }
}