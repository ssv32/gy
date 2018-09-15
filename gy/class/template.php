<?php

class template{
	public $template_url; // ссылка на шаблон
	// public $name; // имя шаблона
	public $lang;

	public function __construct($url){
		global $app;
		$this->template_url = $url.'/template.php';
		$this->lang = new lang($url, 'template', $app->options['lang']);
	}

	/* show - нарисовать/показать шаблон 
	*	arr - массив с данными для шаблона
	*/
	public function show($arr){
		$arRes = $arr;
		include $this->template_url;
		// TODO как то по красивее сделать
	}
}

?>