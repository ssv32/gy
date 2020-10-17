<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

global $USER;

// если есть права просматривать админку
if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'show_admin_panel')) {
    // получить логин пользователя
    $thisLogin = $USER->getDataThisUser()['name'];
    $arRes["auth_user"] = $thisLogin;

    $this->template->show($arRes, $this->arParam);
}