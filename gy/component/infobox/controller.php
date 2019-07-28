<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$data = $_POST;

if( !empty($data['ID']) && is_numeric($data['ID']) ){
    $res = infoBox::deleteInfoBox(array('=' => array('id', $data['ID'])));
    
    if($res){
        $arRes['status'] = 'del-ok';
    }else{
        $arRes['status'] = 'del-err';
    }
}

global $user;
$arRes['ITEMS'] = infoBox::getInfoBox(array(), array('*') );



// показать шаблон
$this->template->show($arRes, $this->arParam);
