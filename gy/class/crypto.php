<?
class crypto{
	
	private $sole; 
	
	public function setSole($sole){
		$this->sole = $sole;
		return true;
	}
	
	public function getSole(){
		return $this->sole;
	}
	
	public function getRandString(){
		return md5(microtime().$this->sole);
	}
	
	public function getStringForUserCookie($login, $name, $id){
		return md5(microtime().$login.$this->sole.$name.$id);
	}

}

?>
