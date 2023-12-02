<?php
declare(strict_types=1);
use Shop\Shop;
use Product\Product;
use Customer\Customer;
use Order\Order;
use OrderProduct\OrderProduct;

function autoload(string $className): void
{
  $filename = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';
  if (is_file($filename)) {
    require_once($filename);
  }
}

spl_autoload_register('autoload');
$pdo = new PDO("sqlite:identifier.sqlite");

$customer = new Customer($pdo);
$order = new Order($pdo);
$orderProduct = new OrderProduct($pdo);
$product = new Product($pdo);
$shop = new Shop($pdo);

$customer->find(2);
$customer->update(1, ['Саня', '88005553535']);
$customer->insert(['name', 'phone' ], ['Вася', '7-777-777-77-77']);
$customer->delete(4);