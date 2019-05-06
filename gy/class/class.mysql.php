<?
/* mysql - класс для работы с базой данных mysql
 * class work mysql 
 */

class mysql extends db{
    
    public $test = 'mysql ok';
    public $db;
    
    /* connect() - create connect in database
    * in: $host, $user, $pass, $name_db
    * out: resurs, false
    */
    public function connect($host, $user, $pass, $name_db){
        $this->db = mysqli_connect($host, $user, $pass, $name_db);
        return $this->db;
    }
    
    /* query()  - out query in database
     * in:  $db - resurs (create self::connect()), $query - string query
     * out: true - ok OR false - not ok
     */
    public function query($db, $query){	// TODO брать прямоиз класса $db
        return mysqli_query($db, $query);
    }
    
    /*  close() - close connect database
     * in: $db - resurs (create self::connect()) 
     * out: true - ok OR false - not ok
     */
    public function close($db){ // TODO авто закрывать коннект при деструкте
        return mysqli_close($db);
    }
	
	public function GetResult_fetch_assoc($res){
		return mysqli_fetch_assoc($res);
	}
}
?>