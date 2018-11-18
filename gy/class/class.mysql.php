<?
class mysql extends db{
    
    public $test = 'mysql ok';
    public $db;
    
    public function connect($host, $user, $pass, $name_db){
        $this->db = mysqli_connect($host, $user, $pass, $name_db);
        return $this->db;
    }
    
    public function query($db, $query){
        return mysqli_query($db, $query);
    }
    
    public function close($db){
        return mysqli_close($db);
    }
}
?>