<?php 
class controller{
	public $model;
	public $controller; // ссылка для запуска выбранного контроллера компонента
	public $lang;

	public function __construct($url){
		global $app;
		$this->controller = $url.'/controller.php';
		$this->lang = new lang($url, 'controller', $app->options['lang']);
	}
	
	public function SetModel($model){ // установить ссылку на модель если есть
		$this->model = $model;
	}

	public function run(){
		$arRes = false;

		// TODO надо сделать лучше
		if (empty($model)){
			include $this->controller;
		}else{
			$model = $this->model;
			include $this->controller;
		}
	
		return $arRes;
	}

}
?>