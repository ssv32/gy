<?php 
// контроллер компонента form_auth (форма авторизации)

// подключить модель // include model this component
if (isset($this->model) ){
	$this->model->includeModel(); 
}	

// были доступны параметры
//echo '$arParam<pre>'; print_r($this->arParam); echo '</pre>';


// $model - теоретически должно быть тут доступно
if (!empty($_REQUEST['auth'])){
	
	$arRes["auth_ok"] = 'ok';
	$arRes["auth_user"] = $_REQUEST['auth'].' '.model_setAuth($_REQUEST['auth']);
} else {

	$arRes["auth"] = "auth";


}

// показать шаблон
$this->template->show($arRes);
?>