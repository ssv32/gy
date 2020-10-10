<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

/** abstract class work database
 * 
 * 
 */
abstract class Db
{
    /** connect() - create connect in database
     * @param string $host - адрис хоста
     * @param string $user - логин
     * @param string $pass - пароль
     * @param string $nameDb - имя БД
     * @param string $port - порт
     * @return resurs, false
     */
    abstract public function connect($host, $user, $pass, $nameDb, $port);

    /** query()  - out query in database
     * @param $db - resurs (create self::connect()), $query - string query
     * @return false or object result query
     */
    abstract public function query($query); // запрос к db

    /**  close() - close connect database
     * @param $db - resurs (create self::connect()) 
     * @return true - ok OR false - not ok
     */
    abstract public function close(); // закрыть подключение к db

    //abstract public function select();

    /**
     * fetch - получить порцию (строку) данных, после выполнения запроса в БД
     * @param $res - результат отработки запроса в БД
     * @return array
    */
    abstract public function fetch($res);

    /**
     * fetchAll - тоже что и fetch только в получит всё в виде массива 
     *     что будет ключём можно указать, либо false тогда вернёт массив 
     *     с ключами по порядку
     * @param $res - результат отработки запроса в БД
     * @param string $key - строка либо false, это что будет ключём в массиве 
     *     (по умолчанию id записи)
     * @return array
    */
    abstract public function fetchAll($res, $key = 'id');

    // TODO в функции ниже добавить параметры сортировки 
    
    /**
     * selectDb - запрос типа select. на получение данных
     * @param $db - resurs (create self::connect())
     * @param string $tableName - имя таблици 
     * @param array $propertys - параметры (какие поля вернуть или * - все)
     * @param array $where - условия запроса, массив специальной структуры в виде 
     *     дерева (может не быть)
     * @return - false or object result query
     */
    abstract public function selectDb($tableName, $propertys, $where = array());

    /**
     * insertDb - вставка, добавление новых строк в базу данных
     * @param string $tableName - имя таблици 
     * @param array $propertys - параметры (поле = значение)
     * @return - false or object result query
     */
    abstract public function insertDb($tableName, $propertys);

    /**
     * updateDb - обновить поле таблици
     * @param string $tableName - имя таблици 
     * @param array $propertys - параметры (поле = значение)
     * @param array $where - условия запроса, массив специальной структуры 
     *     в виде дерева (может не быть)
     * @return - false or object result query
     */
    abstract public function updateDb($tableName, $propertys, $where = array());

    /**
     * createTable - создать таблицу в базе данных
     * @param string $tableName - имя таблици
     * @param array $propertys - параметры 
     *     (приер  login varchar(50), name varchar(50) ...) 
     * @return - false or object result query
     */
    abstract public function createTable($tableName, $propertys);

    /**
     * deleteDb - удаление строк из таблици
     * @param string $tableName - имя таблици
     * @param array $where - условия запроса, что удалять
     * @return boolean
     */
    abstract public function deleteDb($tableName, $where);
}
