<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$arRes = array();

if(!empty($this->arParam['container-data-id']) && !empty($this->arParam['el-id'])  ){
    // получить свойства container-data
    $arRes['PROPERTY'] = containerData::getPropertysContainerData( array('='=>array('id_container_data', $this->arParam['container-data-id'])) );
    
    // получить все типы свойств
    $arRes['PROPERTY_TYPE'] = containerData::getAllTypePropertysContainerData();

    $data = $_REQUEST;

    // сохранение свойств
    if(!empty($data['propertyAdd']) ){
        
        foreach($data['propertyAdd'] as $key => $val){
            $res = containerData::addValuePropertyContainerData(
                $this->arParam['container-data-id'], 
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
    if(!empty($arRes['PROPERTY']) && is_array($arRes['PROPERTY']) ){
        foreach($arRes['PROPERTY'] as $key => $val){
            $propertyValue = containerData::getValuePropertysContainerData(
                $this->arParam['container-data-id'], 
                $this->arParam['el-id'],
                $val['id'],
                $arRes['PROPERTY_TYPE'][$val['id_type_property']]['name_table']
            );

            if(!empty($propertyValue)){
                $arRes['PROPERTY_VALUE'][$val['id']] = $propertyValue;
            }
        }
    }
        
    $arKeyValue = array();
    foreach ($arRes['PROPERTY_VALUE'] as $key => $value) {

        $arKeyValue[$value['id']] = $key;
    }
        
    // обновление
    // сохранение свойств
    if(!empty($data['propertyUpdate']) ){
        
        foreach($data['propertyUpdate'] as $key => $val){
            $res = containerData::UpdateValuePropertyContainerData(
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
    if(!empty($arRes['PROPERTY']) && is_array($arRes['PROPERTY']) ){
        foreach($arRes['PROPERTY'] as $key => $val){
             $propertyValue = containerData::getValuePropertysContainerData(
                $this->arParam['container-data-id'], 
                $this->arParam['el-id'],
                $val['id'],
                $arRes['PROPERTY_TYPE'][$val['id_type_property']]['name_table']
            );

            if(!empty($propertyValue)){
                $arRes['PROPERTY_VALUE'][$val['id']] = $propertyValue;
            }
        }
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
