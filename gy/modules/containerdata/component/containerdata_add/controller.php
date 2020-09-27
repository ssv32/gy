<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

//global $user;
//$arRes['ITEMS'] = ContainerData::getContainerData(array(), array('*') );

// найти текущие значения

$arRes = array();

$arRes['property'] = array(
    'name',
    'code'
);

$data = $_POST;

if(!empty($data)){
    $saveData = array(); 
    foreach ($arRes['property'] as $val){
        $saveData[$val] = $data[$val]; 
    }

    $res = ContainerData::addContainerData($saveData);

    if ($res){
        $arRes['status'] = 'add-ok';
    }else{
        $arRes['status'] = 'add-err';
    }
}else{
    $arRes['status'] = 'add';
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
