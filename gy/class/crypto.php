<?
class crypto{
	
	private $sole; 
	
	public function setSole($sole){
		$this->sole = $sole;
		return true;
	}
	
	public function getRandString(){
		return md5(microtime().$this->sole);
	}
	

}

?>
