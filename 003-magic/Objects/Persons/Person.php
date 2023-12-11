<?php

namespace Objects\Persons;

use JetBrains\PhpStorm\ArrayShape;
class Person
{
    public string $name;
    private string $password;
    private string $login;

    public function __set(string $name, string $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __isset($name)
    {
        return $this->$name;
    }

    public function __sleep()
    {
        return array('name', 'password', 'login');
    }

    #[ArrayShape(['name' => "string", 'password' => "string", 'login' => "string"])] public function __serialize(): array
    {
        return [
            'name' => $this->name,
            'password' => $this->password,
            'login' => $this->login,
        ];
    }

    public function __unserialize(array $data): void
    {
        $this->name = $data['name'];
        $this->password = $data['password'];
        $this->login = $data['login'];
    }

    public function iterator(): void
    {
        foreach ($this as $key => $value) {
            echo "$key => $value\n";
        }
    }

    public function __toString()
    {
        return "$this->name, $this->login, $this->password";
    }
}