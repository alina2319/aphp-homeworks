<?php

declare(strict_types=1);

use Objects\App as App;

echo '### Task 2 ###' . PHP_EOL;

const _DB_Path_= '/mnt/3A7FB2755ACD332E/NETOLOGY/Part-11/HOMEWORKs/APHP-18_4.db/db/phpsqlite.db';
$temp = null;

function tableExists($pdo, $table): bool // ФУНКЦИЯ ПРОВЕРКИ НАЛИЧИЯ ТАБЛИЦЫ В БАЗЕ ДАННЫХ
{
    // Try a select statement against the table
    // Run it in try/catch in case PDO is in ERRMODE_EXCEPTION.
    try {
        $result = $pdo->query("SELECT 1 FROM $table LIMIT 1");
    } catch (Exception $e) {
        // We got an exception == table not found
        return FALSE;
    }

    // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
    return $result !== FALSE;
}

try {
    $pdo = new PDO( "sqlite:" . _DB_Path_, 'root', '') or die("cannot open the database");
    echo 'Connected to the SQLite database successfully!' . PHP_EOL;
    $temp = $pdo;

    // Очистка базы данных (если запуски программы многократные)
    $pdo->exec("DROP TABLE  IF EXISTS Client");
    $pdo->exec("DROP TABLE  IF EXISTS Order_");
    $pdo->exec("DROP TABLE  IF EXISTS Order_product");
    $pdo->exec("DROP TABLE  IF EXISTS Product");
    $pdo->exec("DROP TABLE  IF EXISTS Shop");

    // создание ТАБЛИЦЫ МАГАЗИНА
    $pdo->exec("CREATE TABLE IF NOT EXISTS Shop (
        sh_id INTEGER PRIMARY KEY AUTOINCREMENT,
        sh_name TEXT NOT NULL,
        address TEXT
        );"
    );

    // создание ТАБЛИЦЫ ПРОДУКТОВ
    $pdo->exec("CREATE TABLE IF NOT EXISTS Product (
        p_id INTEGER PRIMARY KEY AUTOINCREMENT,
        p_name TEXT NOT NULL,
        p_price REAL,
        quantity INTEGER,
        FOREIGN KEY(p_id) REFERENCES Shop(sh_id) );"
    );

    // создание ТАБЛИЦЫ ЗАКАЗОВ
    $pdo->exec("CREATE TABLE IF NOT EXISTS Order_ (
        o_id INTEGER PRIMARY KEY AUTOINCREMENT,
        created_at TEXT,
        o_seller TEXT,
        o_buyer TEXT,
        FOREIGN KEY(o_id) REFERENCES Shop(sh_id));"
    );

    // создание ТАБЛИЦЫ СООТВЕТСТВИЯ ПРОДУКТОВ И ЗАКАЗОВ
    $pdo->exec("CREATE TABLE IF NOT EXISTS Order_product (
        op_id INTEGER PRIMARY KEY AUTOINCREMENT,
        op_order TEXT,
        op_product TEXT,
        op_price REAL);"
    );

    // создание ТАБЛИЦЫ ПОКУПАТЕЛЕЙ
    $pdo->exec("CREATE TABLE IF NOT EXISTS Client (
        c_id INTEGER PRIMARY KEY AUTOINCREMENT,
        c_phone TEXT,
        c_name TEXT);"
    );

    // *** заполнение таблицы Shop ***
    $inputShop = new App\SQLiteTableOperation($pdo, 'Shop');
    $shopValues = ['AUTO1', 'auto1@shop.ru'];
    $shopResults = $inputShop -> insert($shopValues);
    unset($inputShop);

    $inputShop = new App\SQLiteTableOperation($pdo, 'Shop');
    $shopValues = ['AUTO2', 'auto2@shop.ru'];
    $shopResults = $inputShop -> insert($shopValues);
    unset($inputShop);

    $inputShop = new App\SQLiteTableOperation($pdo, 'Shop');
    $shopValues = ['AUTO3', 'auto3@shop.ru'];
    $shopResults = $inputShop -> insert($shopValues);
    unset($inputShop);

    $inputShop = new App\SQLiteTableOperation($pdo, 'Shop');
    $shopValues = ['AUTO4', 'auto4@shop.ru'];
    $shopResults = $inputShop -> insert($shopValues);
    unset($inputShop);

    $inputShop = new App\SQLiteTableOperation($pdo, 'Shop');
    $shopValues = ['AUTO5', 'auto5@shop.ru'];
    $shopResults = $inputShop -> insert($shopValues);
    unset($inputShop);
    // *** окончание работы с таблицей Shop ***

    // *** заполнение таблицы Product ***
    $inputProduct = new App\SQLiteTableOperation($pdo, 'Product');
    $productValues = ['gearbox1', 100.0, 10];
    $productResults = $inputProduct -> insert($productValues);
    unset($inputProduct);

    $inputProduct = new App\SQLiteTableOperation($pdo, 'Product');
    $productValues = ['gearbox2', 200.0, 20];
    $productResults = $inputProduct -> insert($productValues);
    unset($inputProduct);

    $inputProduct = new App\SQLiteTableOperation($pdo, 'Product');
    $productValues = ['gearbox3', 300.0, 30];
    $productResults = $inputProduct -> insert($productValues);
    unset($inputProduct);

    $inputProduct = new App\SQLiteTableOperation($pdo, 'Product');
    $productValues = ['gearbox4', 400.0, 40];
    $productResults = $inputProduct -> insert($productValues);
    unset($inputProduct);

    $inputProduct = new App\SQLiteTableOperation($pdo, 'Product');
    $productValues = ['gearbox5', 500.0, 50];
    $productResults = $inputProduct -> insert($productValues);
    unset($inputProduct);
    // *** окончание работы с таблицей Product ***

    // *** заполнение таблицы Order_ ***
    $inputOrder = new App\SQLiteTableOperation($pdo, 'Order_');
    $orderValues = ['8.12.2022 1:35', 'mr. Jones', 'ms. O`Reiley'];
    $orderResults = $inputOrder -> insert($orderValues);
    unset($inputOrder);

    $inputOrder = new App\SQLiteTableOperation($pdo, 'Order_');
    $orderValues = ['7.12.2022 1:35', 'mr. Jones', 'ms. O`Reiley'];
    $orderResults = $inputOrder -> insert($orderValues);
    unset($inputOrder);

    $inputOrder = new App\SQLiteTableOperation($pdo, 'Order_');
    $orderValues = ['6.12.2022 1:35', 'mr. Jones', 'ms. O`Reiley'];
    $orderResults = $inputOrder -> insert($orderValues);
    unset($inputOrder);

    $inputOrder = new App\SQLiteTableOperation($pdo, 'Order_');
    $orderValues = ['5.12.2022 1:35', 'mr. Jones', 'ms. O`Reiley'];
    $orderResults = $inputOrder -> insert($orderValues);
    unset($inputOrder);

    $inputOrder = new App\SQLiteTableOperation($pdo, 'Order_');
    $orderValues = ['4.12.2022 1:35', 'mr. Jones', 'ms. O`Reiley'];
    $orderResults = $inputOrder -> insert($orderValues);
    unset($inputOrder);
    // *** окончание работы с таблицей Order_ ***

    // *** заполнение таблицы Order_product ***
    $inputOrder_product = new App\SQLiteTableOperation($pdo, 'Order_product');
    $order_productValues = [1001, 'gearbox1', 100.0];
    $order_productResults = $inputOrder_product -> insert($order_productValues);
    unset($inputOrder_product);

    $inputOrder_product = new App\SQLiteTableOperation($pdo, 'Order_product');
    $order_productValues = [1002, 'gearbox2', 200.0];
    $order_productResults = $inputOrder_product -> insert($order_productValues);
    unset($inputOrder_product);

    $inputOrder_product = new App\SQLiteTableOperation($pdo, 'Order_product');
    $order_productValues = [1003, 'gearbox3', 300.0];
    $order_productResults = $inputOrder_product -> insert($order_productValues);
    unset($inputOrder_product);

    $inputOrder_product = new App\SQLiteTableOperation($pdo, 'Order_product');
    $order_productValues = [1004, 'gearbox4', 400.0];
    $order_productResults = $inputOrder_product -> insert($order_productValues);
    unset($inputOrder_product);

    $inputOrder_product = new App\SQLiteTableOperation($pdo, 'Order_product');
    $order_productValues = [1005, 'gearbox5', 500.0];
    $order_productResults = $inputOrder_product -> insert($order_productValues);
    unset($inputOrder_product);
    // *** окончание работы с таблицей Order_product ***

    // *** заполнение таблицы Client ***
    $inputClient = new App\SQLiteTableOperation($pdo, 'Client');
    $clientValues = ['8-888-111-22-33', 'ms. O`Reiley'];
    $clientResults = $inputClient -> insert($clientValues);
    unset($inputClient);

    $inputClient = new App\SQLiteTableOperation($pdo, 'Client');
    $clientValues = ['8-888-111-22-44', 'ms. O`Connel'];
    $clientResults = $inputClient -> insert($clientValues);
    unset($inputClient);

    $inputClient = new App\SQLiteTableOperation($pdo, 'Client');
    $clientValues = ['8-888-111-22-55', 'mr. Green'];
    $clientResults = $inputClient -> insert($clientValues);
    unset($inputClient);

    $inputClient = new App\SQLiteTableOperation($pdo, 'Client');
    $clientValues = ['8-888-111-22-77', 'mr. Orange'];
    $clientResults = $inputClient -> insert($clientValues);
    unset($inputClient);

    $inputClient = new App\SQLiteTableOperation($pdo, 'Client');
    $clientValues = ['8-888-111-22-88', 'ms. Gray'];
    $clientResults = $inputClient -> insert($clientValues);
    unset($inputClient);
    // *** окончание работы с таблицей Client ***

    foreach ($shopResults as $shopResult) {
        echo $shopResult['sh_name'] . '|' . $shopResult['address'] . PHP_EOL;
    }


} catch (PDOException $e) {

    print "Error!: ".$e->getMessage() . PHP_EOL;

    if (tableExists($temp, 'Product')) {
        echo 'Wrong operation! This table already exist!' . PHP_EOL;
    } else {
        echo 'Whoops, could not connect to the SQLite database!' . PHP_EOL;
    }
}

echo PHP_EOL;
echo '#### END of Task 2 ###' . PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;


echo '### Task 3 ###' . PHP_EOL;

// *** изменение таблицы Client ***
    $inputClient = new App\SQLiteTableOperation($pdo, 'Client');
    $clientResults = $inputClient -> update(3,['22-22-33', 'John Doe']);
    unset($inputClient);
// *** окончание работы с таблицей Client ***

foreach ($clientResults as $clientResult) {
    echo $clientResult['c_id'] . '. ' . $clientResult['c_phone'] . '|' . $clientResult['c_name'] . PHP_EOL;
}

// *** поиск в таблице Order_product ***
$inputOrder_product = new App\SQLiteTableOperation($pdo, 'Order_product');
$order_productResults = $inputOrder_product -> find(3);
unset($inputOrder_product);
// *** окончание работы с таблицей Order_product ***

    echo $order_productResults[0]['op_id'] . '. '
        . $order_productResults[0]['op_order'] . '|'
        . $order_productResults[0]['op_product']. '|'
        . $order_productResults[0]['op_price'] . PHP_EOL;


// *** удаление из таблицы Client строки ***
$inputClient = new App\SQLiteTableOperation($pdo, 'Client');
$clientResults = $inputClient -> delete(3);
unset($inputClient);
// *** окончание работы с таблицей Client ***

if ($clientResults) {
    echo 'Операция удаления успешно завершена.' . PHP_EOL;
}     else echo 'Ошибка! Запрашиваемая на удаление строка не найдена!' . PHP_EOL;

unset($pdo);

echo PHP_EOL;
echo '#### END of Task 3 ###' . PHP_EOL;
echo PHP_EOL;
echo 'Программа завершена' . PHP_EOL;
