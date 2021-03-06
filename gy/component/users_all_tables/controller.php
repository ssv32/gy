<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$data = $_REQUEST;

global $USER;
$arRes['allUsers'] = $USER->getAllDataUsers();

// взять все группы пользователей
$arRes['allUsersGroups'] = Gy\Core\User\AccessUserGroup::getAccessGroup();

// если идёт удаление пользователя
if (!empty($data['del-id'])
    && is_numeric($data['del-id'])
    && ($data['del-id'] != 1)
    && Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'show_admin_panel')
) {
    $res = $USER->deleteUserById($data['del-id']);
    if ($res) {
        $arRes['del-stat'] = 'ok';
    } else {
        $arRes['del-stat'] = 'err';
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
