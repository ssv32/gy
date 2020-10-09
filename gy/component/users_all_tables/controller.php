<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

$data = $_REQUEST;

global $user;
$arRes['allUsers'] = $user->getAllDataUsers();

// взять все группы пользователей
$arRes['allUsersGroups'] = AccessUserGroup::getAccessGroup();

// если идёт удаление пользователя 
if (!empty($data['del-id']) 
    && is_numeric($data['del-id'])
    && ($data['del-id'] != 1)
    && AccessUserGroup::accessThisUserByAction( 'show_admin_panel')
) {
    $res = $user->deleteUserById($data['del-id']);
    if ($res) {
        $arRes['del-stat'] = 'ok';
    } else {
        $arRes['del-stat'] = 'err';
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
