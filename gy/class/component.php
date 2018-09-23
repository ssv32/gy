<?php 
class component{

	public $template; // тут будут объект класса template
	public $controller;
	public $modele;
	public $url;
	public $lang; 

	public function __construct( $name, $template, $model, $arParam, $url ){
		global $app;
		$this->lang = new lang($url.'/class/', 'component', $app->options['lang']);

		// TODO $template - сюда можно и пустую строку записать
		// могут быть разные шаблоны

		$err = 0;
		$errText = '';

		if (($err == 0) && file_exists($url.'/component/'.$name.'/teplates/'.$template.'/template.php' ) ){ 
			$template = new template($url.'/component/'.$name.'/teplates/'.$template );
		} else {
			$err = 1;
			$errText = $this->lang->GetMessage('err_not_controller');
		}

		if (($err == 0) && file_exists($url.'/component/'.$name.'/controller.php' ) ){ 
			$this->controller = new controller($url.'/component/'.$name); // всегда один
		} else {
			$err = 2;
			$errText = $this->lang->GetMessage('err_not_controller') ;
		}

/* TODO !!! это ещё не протестировано
		if ( ($err == 0) && file_exists($url.'/component/'.$name.'/'.$template.'/modele.php' ) ){ 
			$this->modele = new modele($url.'/component/'.$name.'/modele.php'); // может и не быть
			$this->controller->SetModel($this->modele);
		} else {
			//$err = 3; // это не ошибка
		}
*/
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

	public function run(){
		$arRes = $this->controller->run();
		//$this->template->show($arRes);
	}

	public function ShowErr($err){ // TODO вынести в отдельный класс про ошибки
		echo '<div class=gy_err>'.$err.'</div>';
	}

}
?>