<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

class controller{
	public $model;
	public $controller; // ссылка для запуска выбранного контроллера компонента
	public $lang;
	public $template; // объект шаблона 
	public $arParam;

	public function __construct($url){
		global $app;
		$this->controller = $url.'/controller.php';
		$this->lang = new lang($url, 'controller', $app->options['lang']);
	}
	
    /**
     * SetModel
     * @param type $model
     */
	public function SetModel($model){ // установить ссылку на модель если есть
		$this->model = $model;
	}

    /**
     * SetTemplate - задать шаблон
     * @param object class template $template
     */
	public function SetTemplate($template){  
		$this->template = $template;	
	}

    /**
     * SetArParam - задать параметры компонента // set array property component
     * @param type $arParam
     */
	public function SetArParam($arParam){ 
		$this->arParam = $arParam;
	}

    /**
     * run 
     */
	public function run(){		
		include $this->controller;
	}

}
?>