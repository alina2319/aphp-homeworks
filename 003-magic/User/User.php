<?php
declare(strict_types=1);
namespace User;
use UserLoginInterface\UserLoginInterface;
function autoload(string $className): void
{
  $filename = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
  if (is_file($filename)) {
    require_once($filename);
  }
}

spl_autoload_register('autoload');
abstract class User implements UserLoginInterface
{
  public string $login;
  public string $password;
}