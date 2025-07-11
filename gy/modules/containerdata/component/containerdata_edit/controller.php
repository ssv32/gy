<?php

use Gy\Modules\containerdata\Classes\ContainerData;

if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

//global $USER;
//$arRes['ITEMS'] = ContainerData::getContainerData(array(), array('*') );

// найти текущие значения

$arRes = array();

$arRes['property'] = array(
    'name',
    'code'
);

$data = $_POST;

if (!empty($data['ID'])) {
    
    $saveData = array(); 
    foreach ($arRes['property'] as $val) {
        $saveData[$val] = $data[$val]; 
    }
        
    $res = ContainerData::updateContainerData($saveData, array('=' => array('id', $data['ID'])));
    
    if ($res) {
        $arRes['status'] = 'add-ok';
    } else {
        $arRes['status'] = 'add-err';
    }

} else {
    $arRes['data-this-nfo-box'] = array();
    if (!empty($this->arParam['ID'])) {
        $arRes['data-this-nfo-box'] = ContainerData::getContainerData(array( '=' =>array( 'id', $this->arParam['ID'])), array('*') );
    }
}

// если детальная страница добавим в хлебные крошки
if (!empty($arRes['data-this-nfo-box'][0]['name'])) { 
    $this->arParam['bread-crumbs-items'][] = 'Редактирование контейнера данных - '.$arRes['data-this-nfo-box'][0]['name'];
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
