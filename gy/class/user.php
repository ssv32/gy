<?
class user{ // TODO создавать обьект класса сразу при начале сессии
	
	protected $authorized = false;
	protected $dataUser;
	protected $nameCookie = 'gy_user_auth';
	protected $admin = false; 
	
	public function getDataThisUser(){
		return $this->dataUser;
	}
	
	public function isAdmin(){
		return $this->admin;
	}
	
	/**
	 * getAuthorized - узнать авторизован ли пользователь
	 * @return bool
	 */
	public function getAuthorized(){
		return $this->authorized;
	}
	
	/**
	 * getId - получить id текузего пользователя
	 * @return int
	 */
	public function getId(){
		return $this->dataUser['id'];
	}

	
	public function authorized($log, $pass ){
		$result = $this->chackUser($log, $pass);
		$this->authorized = $result;
		return $result;
	}
	
	protected function chackUser($log, $pass) { 
		$result = false;
		
		global $db;		
		$res = $db->query($db->db, 'select * from users where login="'.$log.'" and pass="'.md5($pass).'"');
			
		if ($arRes = $db->GetResult_fetch_assoc($res)){				
			global $crypto;
			$this->setUserCookie($arRes['id'] , $crypto->getRandString());
			$result = true;		
		}
		
		return $result;
		
	}
	
	protected function setUserCookie($userId, $StringCookie){
		setcookie($this->nameCookie, $StringCookie, 0, '/');
		global $db;
		$db->query($db->db, 'update users set hash_auth="'.$StringCookie.'" where id="'.$userId.'"');
		return true;
	}
	
	protected function deleteUserCookie($userId){
		global $_COOKIE;
		unset($_COOKIE[$this->nameCookie]);
		global $db;
		$db->query($db->db, 'update users set hash_auth="" where id="'.$userId.'"');
		return true;
	}
	
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
	
	protected function findUserByCookie($cookie){
		$result = false;
		
		global $db;
		
		$res = $db->query($db->db, 'select * from users where hash_auth="'.$cookie.'";');
			
		if ($arRes = $db->GetResult_fetch_assoc($res)){
			$result = $arRes;		
		}
				
		return $result;
	}
	
	public function userExit(){
		return $this->deleteUserCookie($this->dataUser['id']);
	}
	
	public function getAllDataUsers(){
		$result = array();
		global $db;		
		$res = $db->query($db->db, 'select * from users');
		while ($arRes = $db->GetResult_fetch_assoc($res)){
			$result[] = $arRes;
		}
		return $result;
	}
	
}
?>