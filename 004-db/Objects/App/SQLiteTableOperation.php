<?php
// ### класс обработки таблицы ###
namespace Objects\App;

use Error;

class SQLiteTableOperation implements \Objects\App\DataWrapperInterface
{
    private object $pdo;
    private string $tableName;      // имя целевой таблицы, над которой производятся операции
    private array $tableColumns;    // массив, содержащий имена полей таблицы (кроме индексного id)
    private string $id_name;        // имя индексного поля
    private array $rows;
    private  array $prefixed_tableColumns;
    private string $update_str;     // строка для вставки в команду UPDATE

    public function __construct(object $pdo, string $tableName)
    {
        $this->pdo = $pdo;
        $this->tableName = $tableName;
        $this->update_str = '';

        // получение списка всех полей целевой таблицы
        $rs = $this->pdo ->query("SELECT * FROM $tableName LIMIT 0");
        for ($i = 0; $i < $rs->columnCount(); $i++) {
            $col = $rs->getColumnMeta($i);
            $columns[] = $col['name'];
            if ($i === 0) $this->id_name = $col['name'];       // сохранение имени индексного поля в отдельной переменной
        }
        unset($columns[0]);                 // удаление индексного/ных поля/лей из списка
        $columns = array_values($columns);  // реиндексация списка всех полей
        $this->tableColumns = $columns;

        foreach ($this->tableColumns as $column) { // формирование нового массива на основе $tableColumns, но с префиксом ":" у каждого элемента
            $this->prefixed_tableColumns[] = ':' . $column;
            $this->update_str .= $column . '=' . ':' . $column . ',';  // формирование строки для вставки в команду UPDATE
        }
        $this->update_str = substr($this->update_str,0,-1); // обрезаем последнюю запятую
    }

    // вставляет новую запись в таблицу, возвращает полученный объект как массив
    public function insert(array $values): array
    {
        try {

            if (count($this->tableColumns) != count($values)) {
                throw new Error('Ошибка! Метод insert: Количество параметров должно быть равно количеству полей в целевой таблице!');
            }

            $str_tableColumns = implode(", ", $this->tableColumns);                           // подготовка перечисления полей таблицы для вставки в запрос
            $str_prefixedTableColumns = implode(", ", $this->prefixed_tableColumns);    // подготовка перечисления полей с префиксами таблицы для вставки в запрос

            echo  '**********************************************************************'.PHP_EOL;
            echo 'Table Name: ' . $this->tableName . PHP_EOL;
            echo 'Table Columns: ' . $str_tableColumns . PHP_EOL;
            echo 'Table operation: Insert.' . PHP_EOL;

            $sqlInsert = "INSERT INTO $this->tableName ($str_tableColumns) VALUES  ($str_prefixedTableColumns)";
           $stmt = $this->pdo->prepare($sqlInsert);

            $i = 0;
            foreach ($this->prefixed_tableColumns as $prefixed_tableColumn) {

                $stmt->bindValue($prefixed_tableColumn, $values[$i]); // связывание значения с полем таблицы
                $i += 1;

            }

            $stmt->execute();                                         // вставка текущего значения в поле таблицы

            $insertId = $this->pdo -> lastInsertId();
            echo "InsertId = $insertId" . PHP_EOL;
            echo  '----------------------------------------------------------------------'.PHP_EOL;

            $sth = $this->pdo -> query("SELECT * FROM $this->tableName"); // запрос в БД для получения всей таблицы
            $this->rows = $sth-> fetchAll();                 // выгрузка значений таблицы в виде массива

        } catch (Error $e) {
            echo $e->getMessage();
        }
        return $this->rows;
    }

    // редактирует строку под конкретным id, возвращает результат после изменения
    public function update(int $id, array $values): array
    {
        try {

            if (count($this->tableColumns) != count($values)) {
                throw new Error('Ошибка! Метод update: Количество элементов массива (второй параметр) должно быть равно количеству полей в целевой таблице!');
            }

            echo  '**********************************************************************'.PHP_EOL;
            $str_tableColumns = implode(", ", $this->tableColumns);
            echo 'Table Name: ' . $this->tableName . PHP_EOL;
            echo 'Table Columns: ' . $str_tableColumns . PHP_EOL;
            echo 'Table operation: Update.' . PHP_EOL;

            $sqlInsert = "UPDATE $this->tableName SET $this->update_str WHERE $this->id_name = $id";

            $stmt = $this->pdo->prepare($sqlInsert);

            $i = 0;
            foreach ($this->prefixed_tableColumns as $prefixed_tableColumn) {

                $stmt->bindValue($prefixed_tableColumn, $values[$i]); // связывание значения с полем таблицы
                $i += 1;

            }

            $stmt->execute();                                         // корректировка значений

            $insertId = $this->pdo -> lastInsertId();
            echo "InsertId = $insertId" . PHP_EOL;
            echo  '----------------------------------------------------------------------'.PHP_EOL;

            $sth = $this->pdo -> query("SELECT * FROM $this->tableName"); // запрос в БД для получения всей таблицы
            $this->rows = $sth-> fetchAll();                 // выгрузка значений таблицы в виде массива

        } catch (Error $e) {
            echo $e->getMessage();
        }

        return $this->rows;
    }

    // поиск по id
    public function find(int $id): array {

        echo  '**********************************************************************'.PHP_EOL;
        echo 'Table Name: ' . $this->tableName . PHP_EOL;
        echo 'Table operation: Find by id.' . PHP_EOL;
        echo  '----------------------------------------------------------------------'.PHP_EOL;

        $sqlInsert = "SELECT * FROM $this->tableName WHERE $this->id_name = $id";
        $stmt = $this->pdo->prepare($sqlInsert);
        $stmt->execute();                                 // поиск значения
        $this->rows = $stmt-> fetchAll();                 // выгрузка найденного значения из таблицы в виде массива

        return $this->rows;
    }

    // удаление по id
    public function delete(int $id): bool{

        echo  '**********************************************************************'.PHP_EOL;
        echo 'Table Name: ' . $this->tableName . PHP_EOL;
        echo 'Table operation: Delete by id.' . PHP_EOL;
        echo  '----------------------------------------------------------------------'.PHP_EOL;

        $sqlInsert = "DELETE FROM $this->tableName WHERE $this->id_name = $id";
        $stmt = $this->pdo->prepare($sqlInsert);
        $stmt->execute();                                 // удаление значения
        //$this->rows = $stmt-> fetchAll();                 // выгрузка найденного значения из таблицы в виде массива

        $affectedRowsNumber = $stmt->rowCount();
        echo "Удалено строк: $affectedRowsNumber" . PHP_EOL;

        if ($affectedRowsNumber > 0)
        {
            $delete_confirm = true;
        } else $delete_confirm = false;

        return $delete_confirm; // результат удаления строки из таблицы (true/false)
    }
}