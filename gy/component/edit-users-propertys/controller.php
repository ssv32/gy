<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

$data = $_REQUEST;

echo "<pre>";
print_r($data);
echo "</pre>";

// получить все возможные типы свойств
$arRes['allTypePropertys'] = allUsersPropertys::getAllTypeAllUsersPropertys();

// получить все общие свойства пользователей которые были созданы
$arRes['allUsersCreatePropertys'] = allUsersPropertys::getAllUsersPropertys();

// получить значения свойств конкретного пользователя
$arRes['valuePropertysThisUser'] = allUsersPropertys::getAllValueUserProperty( $this->arParam['id-user'], 'text'); // text - т.к. пока только такие типы свойств реализованы

echo "allUsersCreatePropertys <pre>";
print_r($arRes['allUsersCreatePropertys']);
echo "</pre>";

echo "valuePropertysThisUser <pre>";
print_r($arRes['valuePropertysThisUser']);
echo "</pre>";

// собираю общий массив
$arRes['propertys'] = array();
foreach ($arRes['allUsersCreatePropertys'] as $key => $value) {
    
    $val = '';
    if(!empty($arRes['valuePropertysThisUser'][$value['id']])){
        $val = $arRes['valuePropertysThisUser'][$value['id']]['value'];
    }
    
    $id = '-';
    if(!empty($arRes['valuePropertysThisUser'][$value['id']])){
        $id = $arRes['valuePropertysThisUser'][$value['id']]['id'];
    }
    
    $arRes['propertys'][] = array(
        'name_property' => $value['name_property'],
        'id' => $id,
        'id_property' => $value['id'],
        'value' => $val
    );
}


// показать шаблон
$this->template->show($arRes, $this->arParam);
