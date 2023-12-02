<?php
declare(strict_types=1);
namespace MobileUser;
use MobileTrait\MobileTrait;

function autoload(string $className): void
{
  $filename = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
  if (is_file($filename)) {
    require_once($filename);
  }
}

spl_autoload_register('autoload');

class MobileUser
{
  public string $login = 'Dima';
  public string $password = '54321';

  use MobileTrait;
}