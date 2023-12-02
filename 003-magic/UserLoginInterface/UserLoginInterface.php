<?php
declare(strict_types=1);
namespace UserLoginInterface;
interface UserLoginInterface
{
  public static function authenticate(string $login, string $password);
}