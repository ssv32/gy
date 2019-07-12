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
    public function query($query){	// TODO брать прямо из класса $db
        return mysqli_query($this->db, $query);
    }
    
    /*  close() - close connect database
     * @param $db - resurs (create self::connect()) 
     * @return true - ok OR false - not ok
     */
    public function close(){
        return mysqli_close($this->db);
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
    
    /**
     * parseWhereForQuery - парсенг параметров where запроса
     *   массив будет в виде дерева, т.е. конечне массивы должны состоять из 2х элементов // TODO добавить примеры в wiki
     * @param type $where
     * @param type $i
     * @param type $key2
     * @return type
     */    
    private function parseWhereForQuery($where, $i, $key2){ // TODO рефакторинг
        $str = '';
        $str2 = '';
        if (is_array($where)){
            $i++;
            foreach($where as $key => $val){
                $str = '';
                $str = $this->parseWhereForQuery($val, $i, $key);
                $str2 .=  ((!empty($str2))? ' '.$key2.' ' : '').$str;
            }
        }else{
            $str2 = $where;
        }   
        return $str2;
    }
    
     /**
     * selectDb - запрос типа select. на получение данных
     * @param $db - расурс, коннект к базе данных
     * @param string $tableName - имя таблици 
     * @param array $propertys - параметры (какие поля вернуть или * - все)
     * @param array $where - условия запроса, массив специальной структуры в виде дерева (может не быть)
     * @return - false or object result query
     */
    public function selectDb($tableName, $propertys, $where = array()){
        $query = 'SELECT ';
        $strPropertys = implode(",", $propertys);

        if(!empty($where)){            
            $where = ' WHERE '.$this->parseWhereForQuery($where, 0, '');
        }else{
            $where = '';
        }
                
        $query .= $strPropertys.' FROM '.$tableName.$where.';';
                 
        return  $this->query($query);
    }
    
    /**
     * insertDb - вставка, добавление новых строк в базу данных
     * @param string $tableName - имя таблици 
     * @param array $propertys - параметры (поле = значение)
     * @return - false or object result query
     */
    public function insertDb($tableName, $propertys){
        $query = '';
        
        // разбить параметры на два списка через запятую // TODO вынести кудато
        global $crypto;
        $nameProperty = '';
		$valueProperty = '';
		foreach ($propertys as $key=> $val){
			$nameProperty .= (($nameProperty != '')? ', ': '').$key;
			
			if ($key == 'pass'){
				$val = md5($val.$crypto->getSole());
			}
			
			if (!is_numeric($val)){
				$val = "'".$val."'";
			}
			
			$valueProperty .= (($valueProperty != '')? ', ': '').$val;
		}
        ////

        $query = "INSERT INTO ".$tableName." (".$nameProperty." ) VALUES(".$valueProperty.")";
               
        return  $this->query($query);
    }
    
    /**
     * updateDb - обновить поле таблици
     * @param string $tableName - имя таблици 
     * @param array $propertys - параметры (поле = значение)
     * @param array $where - условия запроса, массив специальной структуры в виде дерева (может не быть)
     * @return - false or object result query
     */
    public function updateDb($tableName, $propertys, $where = array()){//TODO
        $query = 'UPDATE ';
        $textPropertys = '';
        foreach ($propertys as $key => $val){
            if (!is_numeric($val)){
				$val = "'".$val."'";
			}
            $textPropertys .= ((!empty($textPropertys))? ',': '').' '.$key.'='.$val;
        }

        if(!empty($where)){            
            $where = ' WHERE '.$this->parseWhereForQuery($where, 0, '');
        }else{
            $where = '';
        }
                
        $query .= $tableName.' SET '.$textPropertys.$where.';';
                    
        return  $this->query($query);
    }
    
	public function __destruct() {
		if ( !empty($this->db)){
			$this->close($this->db);
		}
	}
}
