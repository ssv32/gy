<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

//global $user;
//$arRes['ITEMS'] = infoBox::getInfoBox(array(), array('*') );

// найти текущие значения

$arRes = array();

$arRes['property'] = array(
    'name',
    'code'
);

$data = $_POST;

if (!empty($data['ID'])){
    
    $saveData = array(); 
    foreach ($arRes['property'] as $val){
        $saveData[$val] = $data[$val]; 
    }
        
    $res = infoBox::updateInfoBox($saveData, array('=' => array('id', $data['ID'])));
    
    if ($res){
        $arRes['status'] = 'add-ok';
    }else{
        $arRes['status'] = 'add-err';
    }
    
} else {
    if(!empty($this->arParam['ID'])){
        $arRes['data-this-nfo-box'] = infoBox::getInfoBox(array( '=' =>array( 'id', $this->arParam['ID'])), array('*') );
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
