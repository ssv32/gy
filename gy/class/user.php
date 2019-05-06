<?
class user{ // TODO создавать обьект класса сразу при начале сессии
	
	protected $authorized = false;
	protected $id;
	protected $login;
	protected $nameCookie = 'gy_user_auth';
	
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
		return $this->id;
	}

	
	public function authorized($log, $pass ){
		$result = $this->chackUser($log, $pass);
		$this->authorized = $result;
		return $result;
	}
	
	protected function chackUser($log, $pass) { 
		$result = false;
		
		global $db;
		global $db_config;
		
		$db->connect($db_config['db_host'], $db_config['db_user'], $db_config['db_pass'], $db_config['db_name']);
		$res = $db->query($db->db, 'select * from users where login="'.$log.'" and pass="'.md5($pass).'"');
			
		if ($arRes = $db->GetResult_fetch_assoc($res)){				
			global $crypto;
			$this->setUserCookie($arRes['id'] , $crypto->getRandString());
			$result = true;		
		}
		
		$db->close($db->db);

		return $result;
		
	}
	
	protected function setUserCookie($userId, $StringCookie){
		setcookie($this->nameCookie, $StringCookie, 0, '/');
		global $db;
		$db->query($db->db, 'update users set hash_auth="'.$StringCookie.'" where id="'.$userId.'"');
		return true;
	}
	
	public function checkUserCookie(){
		$result = false;
		
		global $_COOKIE;
		
		if(!empty($_COOKIE[$this->nameCookie]) ){
						
			$id = $this->findUserByCookie($_COOKIE[$this->nameCookie]);
						
			if ($id !== false){
				$this->id = $id;
				$this->authorized = true;
				$result = true;
			}
		}
		return $result;
	}
	
	protected function findUserByCookie($cookie){
		$result = false;
		
		global $db;
		global $db_config;
		
		$db->connect($db_config['db_host'], $db_config['db_user'], $db_config['db_pass'], $db_config['db_name']);
		$res = $db->query($db->db, 'select * from users where hash_auth="'.$cookie.'";');
			
		if ($arRes = $db->GetResult_fetch_assoc($res)){
			$result = $arRes['id'];		
		}
		
		$db->close($db->db);
		
		return $result;
	}
	
}
?>