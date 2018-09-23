<?php 
class controller{
	public $model;
	public $controller; // ссылка для запуска выбранного контроллера компонента
	public $lang;
	public $template; // обьект шаблона 
	public $arParam;

	public function __construct($url){
		global $app;
		$this->controller = $url.'/controller.php';
		$this->lang = new lang($url, 'controller', $app->options['lang']);
	}
	
	public function SetModel($model){ // установить ссылку на модель если есть
		$this->model = $model;
	}

	public function SetTemplate($template){ // задать шаблон
		$this->template = $template;	
	}

	public function SetArParam($arParam){ // задать параметры компонента // set array property component
		$this->arParam = $arParam;
	}

	public function run(){		
		include $this->controller;
	}

}
?>