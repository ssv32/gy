<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

// контроллер компонента form_auth (форма авторизации)

// подключить модель // include model this component
if (isset($this->model) ){
    $this->model->includeModel(); 
}	

// были доступны параметры
//echo '$arParam<pre>'; print_r($this->arParam); echo '</pre>';

// если задан параметр idComponent значит сверить с пришедшим
$isChackIdComponent = ( empty($this->arParam['idComponent']) 
    || (!empty($this->arParam['idComponent']) && !empty($_REQUEST['idComponent']) && ($this->arParam['idComponent'] == $_REQUEST['idComponent']) ) 
);

$isShowAdminPanel = false;

if(!empty($_REQUEST['auth'])){
    $thisLogin = $_REQUEST['auth'];
}

global $user;

$isShowAdminPanel = accessUserGroup::accessThisUserByAction( 'show_admin_panel');

$redirectUrl = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);

if ($isShowAdminPanel === true){
		
    $thisLogin = $user->getDataThisUser()['name'];	
    $arRes["auth_ok"] = 'ok';
    $arRes["auth_user"] = $thisLogin;
		
} elseif ( !empty($_REQUEST['auth']) && !empty($_REQUEST['pass']) && !empty($_REQUEST['capcha'])) {
	
    if( capcha::chackCapcha($_REQUEST['capcha']) ){

        $user->authorized($_REQUEST['auth'], $_REQUEST['pass']);
        $isShowAdminPanel = accessUserGroup::accessThisUserByAction( 'show_admin_panel');

        if ($isShowAdminPanel === false){
            $arRes["err"] = 'err1'; 
        }

        if ($isChackIdComponent && $isShowAdminPanel){
            $arRes["auth_ok"] = 'ok';
            $arRes["auth_user"] = $thisLogin;

            header( 'Location: '.$redirectUrl );
        } else {
            $arRes['form_input']["auth"] = "auth";
            $arRes['form_input']["pass"] = "pass";
            header( 'Location: '.$redirectUrl.'?err=err1' );

        }
    }else{
        $arRes['form_input']["auth"] = "auth";
        $arRes['form_input']["pass"] = "pass";
        header( 'Location: '.$redirectUrl.'?err=err_capcha' );
    }
} else {
    if (!empty($_REQUEST['err'])){
        $arRes["err"] = $_REQUEST['err']; 
    }
    $arRes['form_input']["auth"] = "auth";
    $arRes['form_input']["pass"] = "pass";
}

if ( !empty($arRes["auth_ok"]) && ($arRes["auth_ok"] == 'ok') && !empty($_REQUEST['Выйти'])){
    if ($user->userExit() ){
        header( 'Location: '.$redirectUrl );
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
