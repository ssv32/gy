<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

use Gy\Core\User\GeneralUsersPropertys;

$data = $_REQUEST;

// получить все возможные типы свойств
$arRes['allTypePropertys'] = GeneralUsersPropertys::getAllTypeAllUsersPropertys();

// сохранить новое свойство
if (
    !empty($data['name_property'])
    && !empty($data['type_property'])
    && !empty($arRes['allTypePropertys'] )
    && !empty($arRes['allTypePropertys'][$data['type_property']])
    && !empty($data['code'])
) {
    $flag = GeneralUsersPropertys::addUsersPropertys(
        $data['name_property'],
        $data['type_property'],
        $data['code']
    );

    if ($flag) {
        $arRes['stat'] = 'ok';
    } else {
        $arRes['stat'] = 'err';
    }
}


// получить все общие свойства пользователей которые были созданы
$arRes['allUsersCreatePropertys'] = GeneralUsersPropertys::getAllGeneralUsersPropertys();

// если удаление свойства
if (
    is_numeric($data['del-id'])
    && !empty($data['del-id'])
    && !empty($arRes['allUsersCreatePropertys'][$data['del-id']])
) {
    $flag = GeneralUsersPropertys::deleteUserProperty($data['del-id']);
    if ($flag) {
        $arRes['stat'] = 'ok';
    } else {
        $arRes['stat'] = 'err';
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
