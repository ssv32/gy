<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$arRes = array();

if(!empty($this->arParam['info-box-id']) && !empty($this->arParam['el-id'])  ){
    // получить свойства info-box
    $arRes['PROPERTY'] = infoBox::getPropertysInfoBox( array('='=>array('id_info_box', $this->arParam['info-box-id'])) );
    
    // получить все типы свойств
    $arRes['PROPERTY_TYPE'] = infoBox::getAllTypePropertysInfoBox();

    $data = $_REQUEST;

    // сохранение свойств
    if(!empty($data['propertyAdd']) ){
        
        foreach($data['propertyAdd'] as $key => $val){
            $res = infoBox::addValuePropertyInfoBox(
                $this->arParam['info-box-id'], 
                $this->arParam['el-id'], 
                $key,  
                $arRes['PROPERTY_TYPE'][$arRes['PROPERTY'][$key]['id_type_property']]['name_table'], 
                $val
            );
            if($res){
                $arRes['stat-save'] = 'ok';
            }
            
        }
    }
    
    $arRes['PROPERTY_VALUE'] = array();
    
    // получить значения
    foreach($arRes['PROPERTY'] as $key => $val){
        $arRes['PROPERTY_VALUE'][$val['id']] = infoBox::getValuePropertysInfoBox(
            $this->arParam['info-box-id'], 
            $this->arParam['el-id'],
            $val['id'],
            $arRes['PROPERTY_TYPE'][$val['id_type_property']]['name_table']
        );
    }
    
    $arKeyValue = array();
    foreach ($arRes['PROPERTY_VALUE'] as $key => $value) {
        $arKeyValue[$value['id']] = $key;
    }
    
    // обновление
    // сохранение свойств
    if(!empty($data['propertyUpdate']) ){
        
        foreach($data['propertyUpdate'] as $key => $val){
            $res = infoBox::UpdateValuePropertyInfoBox(
                $arRes['PROPERTY_TYPE'][$arRes['PROPERTY'][$arKeyValue[$key]]['id_type_property']]['name_table'],  
                $key,  
                $val
            );
            if($res){
                $arRes['stat-save'] = 'ok';
            }
            
        }
    }
    
    // TODO заменить повторный код на редирект
    $arRes['PROPERTY_VALUE'] = array();
    
    // получить значения
    foreach($arRes['PROPERTY'] as $key => $val){
        $arRes['PROPERTY_VALUE'][$val['id']] = infoBox::getValuePropertysInfoBox(
            $this->arParam['info-box-id'], 
            $this->arParam['el-id'],
            $val['id'],
            $arRes['PROPERTY_TYPE'][$val['id_type_property']]['name_table']
        );
    }
    
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
