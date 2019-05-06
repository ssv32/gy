<?php 
// контроллер компонента form_auth (форма авторизации)

// подключить модель // include model this component
if (isset($this->model) ){
	$this->model->includeModel(); 
}	

// были доступны параметры
//echo '$arParam<pre>'; print_r($this->arParam); echo '</pre>';

// если задан параметр idComponent значит сверить с пришедшим
$isChackIdComponent = ( empty($this->arParam['idComponent']) || (!empty($this->arParam['idComponent']) && ($this->arParam['idComponent'] == $_REQUEST['idComponent']) ) );

$isAuthorized = false;

$thisLogin = $_REQUEST['auth'];

global $user;

$isAuthorized = $user->getAuthorized();
	
if ($isAuthorized === true){
		
	$thisLogin = $user->getId();	
	$arRes["auth_ok"] = 'ok';
	$arRes["auth_user"] = $thisLogin;
		
} elseif ( !empty($_REQUEST['auth']) && !empty($_REQUEST['pass'])) {
	$user->authorized($_REQUEST['auth'], $_REQUEST['pass']);
	$isAuthorized = $user->getAuthorized();
	
	if ($isAuthorized === false){
		$arRes["err"] = 'err1'; 
	}
	
	if ($isChackIdComponent && $isAuthorized){
		$arRes["auth_ok"] = 'ok';
		$arRes["auth_user"] = $thisLogin;
	} else {
		$arRes['form_input']["auth"] = "auth";
		$arRes['form_input']["pass"] = "pass";
	}
} else {
	$arRes['form_input']["auth"] = "auth";
	$arRes['form_input']["pass"] = "pass";
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
?>