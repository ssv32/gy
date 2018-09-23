<?

class model{
	public $url; // ссылка на шаблон

	public function __construct($url){
		$this->url = $url;
	}

	public function includeModel(){		
		include $this->url;
	}
}

?>