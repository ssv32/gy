<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$arRes = array();

// TODO попробовать уменьшить количество запросов

/**
* info-box-code код info-box
* element-code - code элемента
*/
if(!empty($this->arParam['info-box-code']) && !empty($this->arParam['element-code'])){
    
    $isCache = (!empty($this->arParam['cacheTime']) && is_numeric($this->arParam['cacheTime']));
    
    if($isCache){
        global $app; 
        global $cacheClassName;
        $cache = new $cacheClassName($app->url);
        $initCache = $cache->cacheInit('component_infobox_element_show', $this->arParam['cacheTime']);
    }
    
    if($isCache && $initCache){
        $arRes = $cache->getCacheData();
    }
    
    if( !$isCache || ($isCache && !$initCache) ){
                
        // найти info-box
        $dataInfoBox = infoBox::getInfoBox(
            array(
                '=' => array( 'code', "'".$this->arParam['info-box-code']."'") 
            ), 
            array('*')
        );

        $dataInfoBox = $dataInfoBox[0]; 

        // взять типы свойств что бы знать названия таблиц где их искать
        $dataTypeProperty = infoBox::getAllTypePropertysInfoBox();

        // найти его свойства
        $propertyInfoBox = infoBox::getPropertysInfoBox(
            array(
                '='=>array(
                    'id_info_box', 
                    $dataInfoBox['id']
                ) 
            ) 
        );

        // найти элемент
        $dataElement = infoBox::getElementInfoBox(
            array(
                'AND' => array(
                    '=' => array(
                        'id_info_box', 
                        $dataInfoBox['id']
                    ),
                    'AND' => array(
                        '=' => array(
                            'code',
                            "'".$this->arParam['element-code']."'"
                        )
                    )
                )
            )
        );

        // найти значения свойств элемента
        $arRes['ITEMS'] = array();

        foreach ($propertyInfoBox as $val) {
            $arRes['ITEMS'][$val['id']] = infoBox::getValuePropertysInfoBox(
                $dataInfoBox['id'], 
                $dataElement['id'], 
                $val['id'],  
                $dataTypeProperty[$val['id_type_property']]['name_table']
            );
        }
        
        if($isCache){
            $cache->setCacheData($arRes);
        }
    }
    
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
