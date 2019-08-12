<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$arRes = array();

$data = $_POST;

print_r($data);

if (!empty($data['id_info_box']) && !empty($data['name']) && !empty($data['code']) ){
    echo '1111';
    
    $res = infoBox::addElementInfoBox(
        array(
            'section_id' => $data['section_id'],
            'name' => $data['name'],
            'code' => $data['code'],
            'id_info_box' => $data['id_info_box']
        )
    );
    
    if($res){ // TODO добавить редирект
        $arRes['stat'] = 'ok';
    }else{
        $arRes['stat'] = 'err';
    }
    
}

if( !empty($data['del-el']) && !empty($data['id']) ){
    $res = infoBox::deleteElementInfoBox( $data['id']);
     if($res){ // TODO добавить редирект
        $arRes['stat-del'] = 'ok';
    }else{
        $arRes['stat-del'] = 'err';
    }
}

if (!empty($this->arParam['info-box-id']) && is_numeric($this->arParam['info-box-id'])){
    $arRes['ITEMS'] = infoBox::getAllElementInfoBox($this->arParam['info-box-id']);
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
