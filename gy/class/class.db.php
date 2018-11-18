<? 
/* abstract class work database
 * 
 * 
 */
abstract class db{
    /* connect() - create connect in database
     * in: $host, $user, $pass, $name_db
     * out: resurs, false
     */
    abstract public function connect($host, $user, $pass, $name_db); // подключение к db // connect database
    
    /* query()  - out query in database
     * in:  $db - resurs (create self::connect()), $query - string query
     * out: true - ok OR false - not ok
     */
    abstract public function query($db, $query); // запрос к db
    
    /*  close() - close connect database
     * in: $db - resurs (create self::connect()) 
     * out: true - ok OR false - not ok
     */
    abstract public function close($db); // закрыть подключение к db
//    abstract public function select();
}
?>