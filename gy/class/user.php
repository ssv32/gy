<?
class user{ // TODO создавать обьект класса сразу при начале сессии
	
	protected $authorized = false;
	protected $id;
	
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
	
	// TODO работа с БД не очкень универсальна, с другими БД может не работать, нужно добавить методы взятия результата в mysql class и т.д.
	protected function chackUser($log, $pass) { 
		$result = false;
		
		global $db;
		global $db_config;
		
		$db->connect($db_config['db_host'], $db_config['db_user'], $db_config['db_pass'], $db_config['db_name']);
		$res = $db->query($db->db, 'select * from users where login="'.$log.'" and pass="'.md5($pass).'"');
			
		if ($arRes = mysqli_fetch_assoc($res)){
		
			//print_r($arRes);
			
			// TODO установить куку что бы авторизация держалась
			
			/*
			
			mysql_query('update users set hash_auth="12345" where id="'.$arRes[0].'"');
			*/
					
			global $crypto;
			$this->setUserCookie($arRes['id'] , $crypto->getRandString());
			
			$result = true;		
		}
		
		$db->close($db->db);

		return $result;
		
	}
	
	protected function setUserCookie($userId, $StringCookie){
		setcookie('gy_user_auth', $StringCookie);
		global $db;
		$db->query($db->db, 'update users set hash_auth="'.$StringCookie.'" where id="'.$userId.'"');
		return true;
	}
		
}
?>