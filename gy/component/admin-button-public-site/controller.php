<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

global $user;

// если есть права просматривать админку
if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){
    // получить логин пользователя
    $thisLogin = $user->getDataThisUser()['name'];	
    $arRes["auth_user"] = $thisLogin;    
    
    $this->template->show($arRes, $this->arParam);
}