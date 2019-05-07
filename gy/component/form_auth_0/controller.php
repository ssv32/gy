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

$isAdmin = false;

$thisLogin = $_REQUEST['auth'];

global $user;

$isAdmin = $user->isAdmin();

$redirectUrl = str_replace('index.php', '', $_SERVER['DOCUMENT_URI']);

if ($isAdmin === true){
		
	$thisLogin = $user->getDataThisUser()['login'];	
	$arRes["auth_ok"] = 'ok';
	$arRes["auth_user"] = $thisLogin;
		
} elseif ( !empty($_REQUEST['auth']) && !empty($_REQUEST['pass'])) {
	$user->authorized($_REQUEST['auth'], $_REQUEST['pass']);
	$isAdmin = $user->isAdmin();
	
	if ($isAdmin === false){
		$arRes["err"] = 'err1'; 
	}
	
	if ($isChackIdComponent && $isAdmin){
		$arRes["auth_ok"] = 'ok';
		$arRes["auth_user"] = $thisLogin;
		
		header( 'Location: '.$redirectUrl );
	} else {
		$arRes['form_input']["auth"] = "auth";
		$arRes['form_input']["pass"] = "pass";
		header( 'Location: '.$redirectUrl.'?err=err1' );
		
	}
} else {
	if (!empty($_REQUEST['err'])){
		$arRes["err"] = $_REQUEST['err']; 
	}
	$arRes['form_input']["auth"] = "auth";
	$arRes['form_input']["pass"] = "pass";
}

if ( ($arRes["auth_ok"] == 'ok') && !empty($_REQUEST['Выйти'])){
	if ($user->userExit() ){
		header( 'Location: '.$redirectUrl );
	}
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
?>