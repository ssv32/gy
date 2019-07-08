<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

class component{

	public $template; // тут будут объект класса template
	public $controller;
	public $model;
	public $url;
	public $lang; 

	public function __construct( $name, $template, $arParam, $url, $lang ){
		$this->lang = new lang($url.'/class/', 'component', $lang);

		// TODO $template - сюда можно и пустую строку записать
		// могут быть разные шаблоны

		$err = 0;
		$errText = '';

		if (($err == 0) && file_exists($url.'/component/'.$name.'/teplates/'.$template.'/template.php' ) ){ 
			$template = new template($url.'/component/'.$name.'/teplates/'.$template, $lang );
		} else {
			$err = 1;
			$errText = $this->lang->GetMessage('err_not_controller');
		}

		if (($err == 0) && file_exists($url.'/component/'.$name.'/controller.php' ) ){ 
			$this->controller = new controller($url.'/component/'.$name, $lang); // всегда один
		} else {
			$err = 2;
			$errText = $this->lang->GetMessage('err_not_controller') ;
		}


		if ( ($err == 0) && file_exists($url.'/component/'.$name.'/model.php' ) ){ 
			$model = new model($url.'/component/'.$name.'/model.php'); // может и не быть
			$this->controller->SetModel($model);
		} 

		// TODO вывести ошибку если что то не найдено // значит файлы не все есть

		if ($err != 0){ // если есть ошибки 
			$this->ShowErr($errText);
		} else { // иначе запускаем компонент
			
			$this->controller->SetTemplate($template); // задать шаблон	
			$this->controller->SetArParam($arParam); // передать параметры компонента // set array property component 
			
			$this->run();
		}

		$this->url = $url;
	}

    /**
     * run() 
     */
	public function run(){
		$this->controller->run();
		//$this->template->show($arRes);
	}

    /**
     * ShowErr 
     * @param type $err
     */
	public function ShowErr($err){ // TODO вынести в отдельный класс про ошибки
		echo '<div class=gy_err>'.$err.'</div>';
	}

}
