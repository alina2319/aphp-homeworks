<?php

include_once './autoload.php';

use Objects\Users\Users;

$users = new Users();
$users->authenticate('Олег', '1111');
$users->MobileAuthenticate('Иван', '2222');

use Objects\Persons\Person;
use Objects\Persons\PeopleList;

$person1 = new Person();
$person1->name = 'Ivan';
$person1->login = 'IvaIvan';
$person1->password = '3456';
echo $person1 . PHP_EOL;

$person1serialize = serialize($person1);
echo "serialize: $person1serialize" . PHP_EOL;

$person1unserialize = unserialize($person1serialize);
echo "unserialize: $person1unserialize" . PHP_EOL;

$person1->iterator();
$person1 = str_replace('login', 'newLogin', $person1);
echo $person1 . PHP_EOL;

$person2 = new Person();
$person2->name = 'Oleg';
$person2->login = 'OleOleg';
$person2->password = '1234';

$PeopleList = new PeopleList();
$PeopleList->list = $person1;
$PeopleList->list = $person2;
$list = $PeopleList->getList();
foreach ($list as $name => $item){
    echo "$name => $item" . PHP_EOL;
}