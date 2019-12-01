<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

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

    $res = containerData::addContainerData($saveData);

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
