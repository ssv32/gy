<? 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

/** abstract class work database
 * 
 * 
 */
abstract class db{
    /** connect() - create connect in database
     * @param string $host - адрис хоста
     * @param string $user - логин
     * @param string $pass - пароль
     * @param string $name_db - имя БД
     * @return resurs, false
     */
    abstract public function connect($host, $user, $pass, $name_db); // подключение к db // connect database
    
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
	 * GetResult_fetch_assoc 
     * @param $res
	 */
	abstract public function GetResult_fetch_assoc($res);
    
    // TODO в функции ниже добавить параметры сортировки 
    
    /**
     * selectDb - запрос типа select. на получение данных
     * @param $db - resurs (create self::connect())
     * @param string $tableName - имя таблици 
     * @param array $propertys - параметры (какие поля вернуть или * - все)
     * @param array $where - условия запроса, массив специальной структуры в виде дерева (может не быть)
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
     * @param array $where - условия запроса, массив специальной структуры в виде дерева (может не быть)
     * @return - false or object result query
     */
    abstract public function updateDb($tableName, $propertys, $where = array());
}
