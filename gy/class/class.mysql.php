<?
/* mysql - класс для работы с базой данных mysql
 * class work mysql 
 */

class mysql extends db{
    
    public $test = 'mysql ok';
    public $db;
    
    /* connect() - create connect in database
    * @param $host
    * @param $user
    * @param $pass 
    * @param $name_db
    * @return resurs, false
    */
    public function connect($host, $user, $pass, $name_db){
        $this->db = mysqli_connect($host, $user, $pass, $name_db);
        return $this->db;
    }
    
    /* query()  - out query in database
     * @param $db - resurs (create self::connect()), $query - string query
     * @return true - ok OR false - not ok
     */
    public function query($db, $query){	// TODO брать прямо из класса $db
        return mysqli_query($db, $query);
    }
    
    /*  close() - close connect database
     * @param $db - resurs (create self::connect()) 
     * @return true - ok OR false - not ok
     */
    public function close($db){
        return mysqli_close($db);
    }
	
    /**
     * GetResult_fetch_assoc 
     * @param type $res
     * @return type
     */
	public function GetResult_fetch_assoc($res){
		return mysqli_fetch_assoc($res);
	}
	
	public function __construct() {
		if ( empty($this->db)){
			global $db_config;
			if (!empty($db_config)){
				$this->connect($db_config['db_host'], $db_config['db_user'], $db_config['db_pass'], $db_config['db_name']);
			}
		}
	}
	
	public function __destruct() {
		if ( !empty($this->db)){
			$this->close($this->db);
		}
	}
}
?>