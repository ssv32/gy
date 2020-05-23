<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$data = $_REQUEST;

global $user;
$arRes['allUsers'] = $user->getAllDataUsers();

// взять все группы пользователей
$arRes['allUsersGroups'] = accessUserGroup::getAccessGroup();

// если идёт удаление пользователя 
if(!empty($data['del-id']) 
    && is_numeric($data['del-id'])
    && ($data['del-id'] != 1)
    && accessUserGroup::accessThisUserByAction( 'show_admin_panel')
){
    $res = $user->deleteUserById($data['del-id']);
    if ($res){
        $arRes['del-stat'] = 'ok';
    }else{
        $arRes['del-stat'] = 'err';
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
