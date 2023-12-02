<?php
declare(strict_types=1);
namespace AppTrait;
trait AppTrait {
  public static string $appLogin = 'Mishka';
  public static string $appPassword = '12345';

  public static function authenticate(string $login, string $password): void
  {
    if ($login !== self::$appLogin || $password !== self::$appPassword) {
      echo 'Пользователь не найден' . PHP_EOL;
      return;
    }
    echo 'Пользователь приложения:' . PHP_EOL;
    echo 'Логин: ' . self::$appLogin . PHP_EOL;
    echo 'Пароль: ' . self::$appPassword . PHP_EOL;
  }
}