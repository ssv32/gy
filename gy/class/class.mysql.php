<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

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
	
	public function __construct($db_config) {
		if ( empty($this->db)){
			if (!empty($db_config)){
				$this->connect($db_config['db_host'], $db_config['db_user'], $db_config['db_pass'], $db_config['db_name']);
			}
		}
	}
        
    private function parseWhereForQuery($where, $i, $key2){
        $str = '';
        $str2 = '';
        if (is_array($where)){
            $i++;
            foreach($where as $key => $val){
                $str = '';
                $str = $this->parseWhereForQuery($val, $i, $key);
                
                if (!empty($str)) {
                    $str2 .=  ((!empty($str2))? ' '.$key2.' ' : '').$str;
                }
            }
        }else{
            $str2 = $where;
        }   
        return $str2;
    }
    
    public function selectDb($db, $tableName, $propertys, $where = array()){
        $query = 'SELECT ';
        $strPropertys = implode(",", $propertys);
        /*foreach ($propertys as $val){
            $strPropertys .= (($strPropertys != '')? ', ': '')."'".$val."'";
        }*/
        
        if(!empty($where)){            
            $where = ' WHERE '.$this->parseWhereForQuery($where, 0, '');
        }else{
            $where = '';
        }
               
        $query .= $strPropertys.' FROM '.$tableName.$where.';';
         
        //echo $query;
        
        return mysqli_query($db, $query);
    }
    
    public function insertDb($db, $tableName, $propertys, $where = array()){
       
    }
    
    public function updateDb($db, $tableName, $propertys, $where = array()){
        
    }
    
	public function __destruct() {
		if ( !empty($this->db)){
			$this->close($this->db);
		}
	}
}
