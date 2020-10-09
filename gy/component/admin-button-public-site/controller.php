<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $user;

// если есть права просматривать админку
if (AccessUserGroup::accessThisUserByAction( 'show_admin_panel')) {
    // получить логин пользователя
    $thisLogin = $user->getDataThisUser()['name'];	
    $arRes["auth_user"] = $thisLogin;    
    
    $this->template->show($arRes, $this->arParam);
}