<?php
declare(strict_types=1);
namespace AppUser;
use AppTrait\AppTrait;
use User\User;
function autoload(string $className): void
{
  $filename = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
  if (is_file($filename)) {
    require_once($filename);
  }
}

spl_autoload_register('autoload');
class AppUser extends User
{
  public string $login = 'Mishka';
  public string $password = '12345';

  use AppTrait;
}