<?php
declare(strict_types=1);
namespace MobileTrait;
trait MobileTrait {
  public static string $mobileLogin = 'Dima';
  public static string $mobilePassword = '54321';

  public static function authenticate(string $login, string $password): void
  {
    if ($login !== self::$mobileLogin || $password !== self::$mobilePassword) {
      echo 'Пользователь не найден' . PHP_EOL;
      return;
    }
    echo 'Пользователь мобильного приложения:' . PHP_EOL;
    echo 'Логин: ' . self::$mobileLogin . PHP_EOL;
    echo 'Пароль: ' . self::$mobilePassword . PHP_EOL;
  }
}