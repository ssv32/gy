<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$arRes = array();

// взять все группы пользователей
$arRes['allUsersGroups'] = accessUserGroup::getAccessGroup();

// взять все дефствия поьзователей 
$arRes['allActionUser'] = accessUserGroup::getUserAction();

$data = $_REQUEST;

global $user;

if(!empty($data['button-form'])
    && ($data['button-form'] == 'Сохранить')
    && $user->isAdmin() // TODO пока только админы могут это делать
    && !empty($data['groupsActions'])
){ // нужно сохранить новые настроки прав
    foreach ($data['groupsActions'] as $key => $listActionUser){
        // удалить все настройки для определённой группы
        accessUserGroup::deleteAllActionsForGroup($key);
        
        foreach ($listActionUser as $nameActionsUser) {
            accessUserGroup::addOptionsGroup($key, $nameActionsUser);
        }
    }
    $arRes['status'] = 'ok';
} elseif(!empty($data['button-form']) ){
    $arRes['status'] = 'add-err';
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
