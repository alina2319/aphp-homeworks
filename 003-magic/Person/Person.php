<?php
declare(strict_types=1);
namespace Person;
class Person
{

  public array $arr = [];

  public function __set($prop, $value): void
  {
    $this->arr[$prop] = $value;
  }

  public function __get($prop): void
  {
    echo "$prop пользователя: " . $this->arr[$prop] . PHP_EOL;
  }

  public function __isset($prop): bool
  {
    echo isset($this->arr[$prop]) ? 'Свойство существует' : 'Свойство не существует' . PHP_EOL;
    return isset($this->arr[$prop]);
  }


  public function __sleep() {
    echo 'Начинаем конвертировать объект в строку' . PHP_EOL;
    return ['name', 'age', 'level'];
  }

  public function __wakeup() {
    echo 'Начинаем конвертировать строку в объект' . PHP_EOL;
  }

  public function __toString() {
    return serialize($this->arr);
  }
}
