<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

//global $user;
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
    if (!empty($this->arParam['ID'])) {
        $arRes['data-this-nfo-box'] = ContainerData::getContainerData(array( '=' =>array( 'id', $this->arParam['ID'])), array('*') );
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
