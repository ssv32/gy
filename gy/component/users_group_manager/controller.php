<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$arRes = array();
$data = $_REQUEST;

// добавить новую группу если добавляется новая
if ( !empty($data['add-group-name'])
    && !empty( $data['add-group-code'])
    && !empty( $data['add-group-text'])
    && !empty( $data['groupsActions']['add-group-action-user'])
) {

    $res = AccessUserGroup::addUserGroup(
        array(
            'code' => $data['add-group-code'],
            'text' => $data['add-group-text'],
            'name' => $data['add-group-name']
        ),
        $data['groupsActions']['add-group-action-user']
    );
    unset($data['groupsActions']['add-group-action-user']);
}

// удалить группы, отмеченные для удаления
if (!empty($data['delete'])) {
    foreach ($data['delete'] as $codeDeleteGroup => $val) {
        AccessUserGroup::deleteUserGroupByCode($codeDeleteGroup);
    }
}

// взять все группы пользователей
$arRes['allUsersGroups'] = AccessUserGroup::getAccessGroup();

// взять все дефствия поьзователей 
$arRes['allActionUser'] = AccessUserGroup::getUserAction();

// коды групп пользователей которые даны по умолчанию (их нельзя будет удалять)
$standartGroup = array(
    'admins',
    'content',
    'user_admin'
);
foreach ($arRes['allUsersGroups'] as $key => $value) {
    if (!in_array($value['code'], $standartGroup)) {
        $arRes['allUsersGroups'][$key]['flag_del'] = 'Y'; // флаг что можно удалить группу
    }
}

global $user;

// надо убрать админа из списка что бы права нельзя было менять никому
unset($data['groupsActions']['admins']);

if (!empty($data['button-form'])
    && ($data['button-form'] == 'Сохранить')
    && $user->isAdmin() // TODO пока только админы могут это делать
    && !empty($data['groupsActions'])
) { // нужно сохранить новые настроки прав
    foreach ($data['groupsActions'] as $key => $listActionUser) {
        // удалить все настройки для определённой группы
        AccessUserGroup::deleteAllActionsForGroup($key);
        
        foreach ($listActionUser as $nameActionsUser) {
            AccessUserGroup::addOptionsGroup($key, $nameActionsUser);
        }
    }
    $arRes['status'] = 'ok';
} elseif (!empty($data['button-form'])) {
    $arRes['status'] = 'add-err';
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
