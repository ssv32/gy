<?php
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

class template{
	public $template_url; // ссылка на шаблон
	// public $name; // имя шаблона
	public $lang;

	public function __construct($url, $lang){
		$this->template_url = $url.'/template.php';
		$this->lang = new lang($url, 'template', $lang);
	}

	/* show - нарисовать/показать шаблон 
	*	arr - массив с данными для шаблона
	*/
	/*public function show($arr){
		$arRes = $arr;
		include $this->template_url;
		// TODO как то по красивее сделать
	}*/

	/** 
	 * show - нарисовать/показать шаблон 
	 * @param $arRes - массив с данными для шаблона // array for template
	 * 
	 * @return void - ничего не вернёт, подключится файл шаблона // include template
	 */
	public function show($arRes, $arParam){
		include $this->template_url;
	}
}

?>