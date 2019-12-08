<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

class component{

	public $template; // тут будут объект класса template
	public $controller;
	public $model;
	public $url;
	public $lang; 

	public function __construct( $name, $template, $arParam, $url, $lang ){
		$this->lang = new lang($url.'/classes/', 'component', $lang);

		// TODO $template - сюда можно и пустую строку записать
		// могут быть разные шаблоны

		$err = 0;
		$errText = '';
        
        // нужно попробовать найти подключаемый компонент среди подключённых можулей
        global $module;
        $urlComponentInModule = $module->getModulesComponent($name);
                
        if (($err == 0) && file_exists($url.'/customDir/component/'.$name.'/teplates/'.$template.'/template.php' ) ){
            // если есть такой компонент и указанный шаблон в папке /customDir/ то подключить от туда
            $template = new template($url.'/customDir/component/'.$name.'/teplates/'.$template, $lang ); 
        }elseif(($urlComponentInModule !== false) && file_exists($urlComponentInModule.'/teplates/'.$template.'/template.php' ) ){
            // проверить нет ли компонента среди подключенных модулей
            $template = new template($urlComponentInModule.'/teplates/'.$template, $lang ); 
        }elseif(($err == 0) && file_exists($url.'/gy/component/'.$name.'/teplates/'.$template.'/template.php' ) ){ 
            // если нет то поискать шаблон в стандартной папке с компонентами
			$template = new template($url.'/gy/component/'.$name.'/teplates/'.$template, $lang );
		} else {
			$err = 1;
			$errText = $this->lang->GetMessage('err_not_controller');
		}
                
        if (($err == 0) && file_exists($url.'/customDir/component/'.$name.'/controller.php' ) ){ 
            $this->controller = new controller($url.'/customDir/component/'.$name, $lang); // всегда один
        }elseif(($urlComponentInModule !== false) && file_exists($urlComponentInModule.'/controller.php' ) ){              
            $this->controller = new controller($urlComponentInModule, $lang);
        }elseif(($err == 0) && file_exists($url.'/gy/component/'.$name.'/controller.php' ) ){ 
			$this->controller = new controller($url.'/gy/component/'.$name, $lang); // всегда один
		} else {
			$err = 2;
			$errText = $this->lang->GetMessage('err_not_controller') ;
		}
                
		if ( ($err == 0) && file_exists($url.'/customDir/component/'.$name.'/model.php' ) ){ 
            $model = new model($url.'/customDir/component/'.$name.'/model.php'); // может и не быть
			$this->controller->SetModel($model);
        }elseif(($urlComponentInModule !== false) && file_exists($urlComponentInModule.'/model.php' )){
            $model = new model($urlComponentInModule.'/model.php'); // может и не быть
			$this->controller->SetModel($model);
        }elseif( ($err == 0) && file_exists($url.'/gy/component/'.$name.'/model.php' ) ){ 
			$model = new model($url.'/gy/component/'.$name.'/model.php'); // может и не быть
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

		$this->url = $url.'/gy';
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
