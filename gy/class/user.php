<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

class user{ // TODO создавать объект класса сразу при начале сессии
	
	protected $authorized = false;
	protected $dataUser;
	protected $nameCookie = 'gy_user_auth';
	protected $admin = false; 
	
    /**
     * getDataThisUser - получить данные по текущему, авторизованному пользователю
     * @return array
     */
	public function getDataThisUser(){
		return $this->dataUser;
	}
	
    /**
     * isAdmin - проверить является ли текущий, авторизованный пользователем администратором
     * @return booleand
     */
	public function isAdmin(){
		return $this->admin;
	}
	
	/**
	 * getAuthorized - узнать авторизован ли пользователь
	 * @return booleand
	 */
	public function getAuthorized(){
		return $this->authorized;
	}
	
	/**
	 * getId - получить id текущего пользователя
	 * @return int
	 */
	public function getId(){
		return $this->dataUser['id'];
	}

	/**
     * authorized - авторизовать пользователя
     * @param type $log - логин
     * @param type $pass - пароль
     * @return booleand 
     */
	public function authorized($log, $pass ){
		$result = $this->chackUser($log, $pass);
		$this->authorized = $result;
		return $result;
	}
	
    /**
     * chackUser - проверить существует ли пользователь
     * @global type $db
     * @global type $crypto
     * @param type $log - логин
     * @param type $pass - пароль
     * @return booleand
     */
	protected function chackUser($log, $pass) { 
		$result = false;
		
		global $db;
		global $crypto;		
			
        $res = $db->selectDb(
            'users', 
            array('*'), 
            array(
                'AND' => array( 
                    '=' => array('login', "'".$log."'" ),
                    'AND' => array( '=' => array('pass',"'".md5($pass.$crypto->getSole())."'") )
                ),   
            )    
        );
        
		if ($arRes = $db->GetResult_fetch_assoc($res)){				
			
			//$this->setUserCookie($arRes['id'] , $crypto->getRandString());
			$this->setUserCookie($arRes['id'] , $crypto->getStringForUserCookie($arRes['login'], $arRes['name'], $arRes['id']));
			$result = true;		
		}
		
		return $result;
		
	}
	
    /**
     * setUserCookie - установить пользовательскую куку
     * @global type $db
     * @param int $userId - id пользователя
     * @param string $StringCookie - строка, значение куки
     * @return boolean
     */
	protected function setUserCookie($userId, $StringCookie){
		setcookie($this->nameCookie, $StringCookie, 0, '/');
		global $db;
		$db->query('update users set hash_auth="'.$StringCookie.'" where id="'.$userId.'"');
		return true;
	}
	
    /**
     * deleteUserCookie - удалить пользовательскую куку
     * @global type $_COOKIE
     * @global type $db
     * @param int $userId - id пользователя
     * @return boolean
     */
	protected function deleteUserCookie($userId){
		global $_COOKIE;
		unset($_COOKIE[$this->nameCookie]);
		global $db;
		$db->query('update users set hash_auth="NULL" where id="'.$userId.'"');
		return true;
	}
	
    /**
     * checkUserCookie - проверить пользовательскую куку
     * @global type $_COOKIE
     * @return boolean
     */
	public function checkUserCookie(){
		$result = false;
		
		global $_COOKIE;
		
		if(!empty($_COOKIE[$this->nameCookie]) ){
						
			$dataUser = $this->findUserByCookie($_COOKIE[$this->nameCookie]);
						
			if ($dataUser !== false){
				$this->dataUser = $dataUser;
				$this->authorized = true;
				if ($dataUser['groups'] == 1){
					$this->admin = true;
				}
				$result = true;
			}
		}
		return $result;
	}
	
    /**
     * findUserByCookie - найти пользователя по значению куки
     * @global type $db
     * @param string $cookie
     * @return array - данные пользователя
     */
	protected function findUserByCookie($cookie){
		$result = false;
		
		global $db;
		
		//$res = $db->query($db->db, 'select * from users where hash_auth="'.$cookie.'";');
			
        $res = $db->selectDb(
            'users', 
            array('*'), 
            array( '=' => array('hash_auth', "'".$cookie."'") ) 
        );
        
		if ($arRes = $db->GetResult_fetch_assoc($res)){
			$result = $arRes;		
		}
				
		return $result;
	}
	
    /**
     * userExit - сделать выход для пользователя 
     * @return boolean
     */
	public function userExit(){
		return $this->deleteUserCookie($this->dataUser['id']);
	}
	
    /**
     * getAllDataUsers - получить данные по пользователю 
     * @global type $db
     * @return array
     */
	public function getAllDataUsers(){
		$result = array();
		global $db;		
		//$res = $db->query($db->db, 'select * from users');
        
        $res = $db->selectDb( 
            'users', 
            array('*')
        );
        
		while ($arRes = $db->GetResult_fetch_assoc($res)){
			$result[] = $arRes;
		}
		return $result;
	}
	
    /**
     * addUsers - добавить пользователя
     * @global type $db
     * @global type $crypto
     * @param type $data
     * @return boolean
     */
	public function addUsers($data){
		$result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->insertDb('users', $data);
        
        if ($res){
			$result = true;
		}
			
		return $result;
	}
	
    /**
     * deleteUserById - удалить пользователя
     * @global type $db
     * @param int $idUser - id пользователя
     * @return string
     */
	public function deleteUserById($idUser){
		$result = false;
		
		if (is_numeric($idUser) && ($idUser != 1)){
			global $db;
			
			$res = $db->query('DELETE FROM users WHERE id = '.$idUser.';');

			if ($res){
				$result = 'true';		
			}
		}		
		return $result;
	}
	
}
