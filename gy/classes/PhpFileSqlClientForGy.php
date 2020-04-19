<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

/* PhpFileSqlClientForGy - класс для работы с базой данных PhpFileSql
 *   https://github.com/ssv32/PhpFileSql
 * class work PhpFileSql 
 */

class PhpFileSqlClientForGy extends db{
    
    public $test = 'PhpFileSqlClient ok';
    public $db; //TODO private
        
    /* connect() - create connect in database
    * @param $host
    * @param $user
    * @param $pass 
    * @param $name_db
    * @return resurs, false
    */
    public function connect($dir, $login, $pass, $name_db){
        $phpFileSql = new PhpFileSql($dir);
        $phpFileSql->connect($login, $pass, $name_db);
        
        $this->db = $phpFileSql;
        return $this;
        
    }
    
    /* query()  - out query in database //TODO
     * @param $db - resurs (create self::connect()), $query - string query
     * @return true - ok OR false - not ok
     */
    public function query($query){	
        // 
    }
    
    /*  close() - close connect database
     * @param $db - resurs (create self::connect()) 
     * @return true - ok OR false - not ok
     */
    public function close(){
        if ( !empty($this->db)){
            $phpFileSql = $this->db;
            return $phpFileSql->close();
        }else{
            return false;
        }
    }
	
    /** //TODO
     * fetch - получить порцию (строку) данных, после выполнения запроса в БД
     * @param $res - результат отработки запроса в БД
     * @return array
     */
    public function fetch($res){
        $result = array();
        if ($res !== false){
            //$result = mysqli_fetch_assoc($res);
        }
        return $result;
    }
	
    /** //TODO
     * fetchAll - тоже что и fetch только в получит всё в виде массива (с ключём id элемента)
     * @param $res - результат отработки запроса в БД
     * @return array
     */
    public function fetchAll($res, $key = 'id'){
        $result = array();
        while ($arRes = self::fetch($res)){
            if($key !== false){
                $result[$arRes[$key]] = $arRes;
            }else{
                $result[] = $arRes;
            }
		}
        return $result;
    }
    
    public function __construct($db_config) {
        if ( empty($this->db)){
            if (!empty($db_config)){
                $this->connect($db_config['db_url'], $db_config['db_user'], $db_config['db_pass'], $db_config['db_name']);
            }
        }
    }

    /** 
     * parseWhereForQuery - парсинг параметров where запроса
     *   массив будет в виде дерева, т.е. конечные массивы должны состоять из 2х элементов // TODO добавить примеры в wiki
     * @param type $where
     * @param type $i
     * @param type $key2
     * @return type
     */    
    private function parseWhereForQuery($where, $i, $key2){ 
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
    
     /** //TODO
     * selectDb - запрос типа select. на получение данных
     * @param $db - расурс, коннект к базе данных
     * @param string $tableName - имя таблицы 
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
     * @param string $tableName - имя таблицы 
     * @param array $propertys - параметры (поле = значение)
     * @return - false or object result query
     */
    public function insertDb($tableName, $propertys){   
        global $crypto;
        
        // если встречается пароль то засолить и зашифровать его
        if(!empty($propertys['pass'])){
            $propertys['pass'] = md5($propertys['pass'].$crypto->getSole());
        }

        return  $this->db->insertInto($tableName, $propertys);
    }
    
    /** 
     * updateDb - обновить поле таблицы
     * @param string $tableName - имя таблицы
     * @param array $propertys - параметры (поле = значение)
     * @param array $where - условия запроса, массив специальной структуры в виде дерева (может не быть)
     * @return - false or object result query
     */
    public function updateDb($tableName, $propertys, $where = array()){
        
        // подготовить массив с условиями для класса PhpFileSql
        $where = $this->createTrueArrayWhereFromPhpFileSql($where);
               
        // если встречается пароль то засолить и зашифровать его
        global $crypto;
        if(!empty($propertys['pass'])){
            $propertys['pass'] = md5($propertys['pass'].$crypto->getSole());
        }

        return $this->db->update($tableName, $propertys, $where);
    }
    
    /** // TODO сделать PRIMARY KEY AUTO_INCREMENT
     * createTable - создать таблицу в базе данных
     * @param string $tableName - имя таблицы
     * @param array $propertys - параметры (приер  login varchar(50), name varchar(50) ...) 
     * @return - false or object result query
     */
    public function createTable($tableName, $propertys){
        // массив мараметров подходящий для PhpFileSql метода createTable
        $arrayColumns = array();
        
        // нужно подогнать свойства под метод класса PhpFileSql
        foreach($propertys as $val){
            $attr = explode(' ', $val);
            $arrayColumns[] = $attr[0];
        }      

        return $this->db->createTable($tableName, $arrayColumns);
    }
    
    /** //TODO из за условий может работать не на всём, желательно ещё потестировать
     * deleteDb - удаление строк из таблицы
     * @param string $tableName - имя таблицы
     * @param array $where - условия запроса, что удалять
     * @return boolean
     */
    public function deleteDb($tableName, $where){

        // подготовить массив с условиями для класса PhpFileSql
        $where = $this->createTrueArrayWhereFromPhpFileSql($where);
        
        return $this->db->delete($tableName, $where);
    }
    
    /**
     * createTrueArrayWhereFromPhpFileSql 
     *  - сделать массив where к виду подходящему для класса PhpFileSql
     * 
     * @param array $where
     * @return array
     */
    public function createTrueArrayWhereFromPhpFileSql($where){
        foreach ($where as $key1 => $value1) {
            if(is_array($value1)){
                foreach($value1 as $key2 => $value2){
                    $where[$key1][$key2] = str_replace("'", '', $value2);
                }
            }else{
                $where[$key1] = str_replace("'", '', $value);
            }
        }
        return $where;
    }
    
    public function __destruct() {
        $this->close();
    }
}
