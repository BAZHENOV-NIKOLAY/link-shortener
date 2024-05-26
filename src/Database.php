<?php
require_once 'Config.php';

class Database {
    
    private static $db;
    private $pdo;

    //закрытый конструктор
    private function __construct() {
        try {
            $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {  
            echo 'Ошибка при подключении к базе данных: '.$e->getMessage();
        }
    }

    //статическое поле для подключения БД в 1 экземпляре
    public static function getDBO() {
        if (!self::$db) self::$db = new Database();
        return self::$db;
    }

    //вернуть количество строк таблицы можно задавать условие
    public function getCountRows(string $table_name, string $where = '', array $values = []) : int {
        $sql = 'SELECT COUNT(`id`) as `count` FROM '.$this->getTableName($table_name);
        if ($where) $sql .= " WHERE $where";
        $query = $this->pdo->prepare($sql);
        $query->execute($values);
        return $query->fetchColumn();
    }
 
    //присоединение префикса таблицы
    private function getTableName(string $table_name) : string {
        return '`'.DB_PREFIX.$table_name.'`';
    }
    
    
    //вернуть строки таблицы можно задавать условие
    public function getRows(string $table_name, string $where = '', array $values = [], string $order_by = '') : array {
        $sql = 'SELECT * FROM '.$this->getTableName($table_name);
        if ($where) $sql .= " WHERE $where";
        if ($order_by) $sql .= " ORDER BY `$order_by` DESC";
        $query = $this->pdo->prepare($sql);
        $query->execute($values);
        return $query->fetchAll();
    }
    
    //вернуть 1 строку по условию
    public function getRowByWhere(string $table_name, string $where, array $values = []) : array {
        $sql = 'SELECT * FROM '.$this->getTableName($table_name)." WHERE $where";
        $query = $this->pdo->prepare($sql);
        $query->execute($values);
        $result = $query->fetch();
        if ($result) return $result;
        return [];
    }
    
    //вернуть строку по id
    public function getRowById(string $table_name, int $id) : array {
        return $this->getRowByWhere($table_name, '`id` = ?', [$id]);
    }
    
    
    //вернуть строки по нескольким id
    public function getRowsByIds(string $table_name, array $ids) : array {
        if ($ids) {
            $in = str_repeat('?,', count($ids) - 1).'?';
            $sql = 'SELECT * FROM '.$this->getTableName($table_name)." WHERE `id` IN ($in)";
            $query = $this->pdo->prepare($sql);
            $query->execute($ids);
            $result = [];
            foreach ($query->fetchAll() as $row) {
                $result[$row['id']] = $row;
            }
            return $result;
        }
        return [];
    }
    
    
    //запрос на обновление
    public function update(string $table_name, array $fields, array $values, string $where = '', array $where_values = []) {
        $sql = 'UPDATE '.$this->getTableName($table_name).' SET ';
        foreach ($fields as $field) {
            $sql .= "`$field` = ?,";
        }
        $sql = substr($sql, 0, -1);
        if ($where) $sql .= " WHERE $where";
        $query = $this->pdo->prepare($sql);
        $query->execute(array_merge($values, $where_values));
    }
    
    //добавление строк
    public function insert(string $table_name, array $fields, array $values) {
        $sql = 'INSERT iNTO '.$this->getTableName($table_name).' (';
        foreach ($fields as $field) {
            $sql .= "`$field`,";
        }
        $sql = substr($sql, 0, -1).') VALUES (';
        $sql .= str_repeat('?,', count($fields) - 1).'?)';
        $query = $this->pdo->prepare($sql);
        $query->execute($values);
    }
    
    //удаление строк
    public function delete(string $table_name, string $where, array $values) {
        $sql = 'DELETE FROM'.$this->getTableName($table_name)." WHERE $where";
        $query = $this->pdo->prepare($sql);
        $query->execute($values);
    }
    
    
    
    //деструктор
    public function __destruct() {
        $this->pdo = null;
    }
    
}

?>

















