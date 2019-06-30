<? 
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
     * @return true - ok OR false - not ok
     */
    abstract public function query($db, $query); // запрос к db
    
    /**  close() - close connect database
     * @param $db - resurs (create self::connect()) 
     * @return true - ok OR false - not ok
     */
    abstract public function close($db); // закрыть подключение к db
    
    //abstract public function select();
	
	/**
	 * GetResult_fetch_assoc 
     * @param $res
	 */
	abstract public function GetResult_fetch_assoc($res);
}
?>