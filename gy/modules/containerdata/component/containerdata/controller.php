<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$data = $_POST;

if (!empty($data['ID']) && is_numeric($data['ID'])) {
    $res = ContainerData::deleteContainerData($data['ID']);
    
    if ($res) {
        $arRes['status'] = 'del-ok';
    } else {
        $arRes['status'] = 'del-err';
    }
}

global $user;
$arRes['ITEMS'] = ContainerData::getContainerData(array(), array('*') );

// показать шаблон
$this->template->show($arRes, $this->arParam);
