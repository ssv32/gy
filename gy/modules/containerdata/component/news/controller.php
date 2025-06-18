<?php

use Gy\Modules\containerdata\Classes\ContainerData;
use Gy\Tools\Pagination;

if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$arRes = array();

$data = $_REQUEST;

$flagTrueContainerDataId = false;

if (!empty($this->arParam['container-data-id']) && is_numeric($this->arParam['container-data-id'])) {
    $flagTrueContainerDataId = true;
} elseif ($this->arParam['container-data-code']) {
    $dataContainerDataId = ContainerData::getContainerData(array('=' => array('code', "'".$this->arParam['container-data-code']."'")), array('id'));
    if (!empty($dataContainerDataId[0]['id'])) {    
    $this->arParam['container-data-id'] = $dataContainerDataId[0]['id'];    
    if (!empty($this->arParam['container-data-id']) && is_numeric($this->arParam['container-data-id'])) {
        $flagTrueContainerDataId = true;
    }
        
    }
}

/*
    'show-in-url-code' => 1, // TODO 1/0 чпу
*/

if ($flagTrueContainerDataId){
    
    global $APP; 
    global $CACHE_CLASS_NAME;
    
    $cache = new $CACHE_CLASS_NAME($APP->url);
    $initCache = $cache->cacheInit('getItemsNews', $this->arParam['cacheTime']); // инициализация кеша

    if ($initCache){ 
        $arRes['ITEMS'] = $cache->getCacheData(); // получение данных из кеша
    }else{

        // TODO это быстрое решение берётся всё сразу, для мелкого проекта норм, но можно брать только то что нужно
        $arRes['ITEMS'] = ContainerData::getAllElementContainerData($this->arParam['container-data-id']);

        // получить свойства container-data
        $property = ContainerData::getPropertysContainerData( array('='=>array('id_container_data', $this->arParam['container-data-id'])) );

        foreach ($property as $key=> $value) {
            if (!in_array($value['code'], $this->arParam['show-property-news'])) {
                unset($property[$key]);
            }
        }

        // получить все типы свойств
        $propertyType = ContainerData::getAllTypePropertysContainerData();

        // получить значения //TODO слишком много запросов, переделать бы
        if (!empty($property) && is_array($property)) {
            foreach ($arRes['ITEMS'] as $key0 => $valueElement) {

                foreach ($property as $key => $val) {
                    $arRes['ITEMS'][$key0]['property'][$val['code']] = $val;

                    $propertyValue = ContainerData::getValuePropertysContainerData(
                        $this->arParam['container-data-id'],
                        $valueElement['id'],
                        $val['id'],
                        $propertyType[$val['id_type_property']]['name_table']
                    );

                    if (!empty($propertyValue)) {

                        $arRes['ITEMS'][$key0]['property'][$val['code']]['value'] = $propertyValue;
                    }
                }

            }
        }
 
        $cache->setCacheData($arRes['ITEMS']); // запись данных в кеш
    }
} else {
    $arRes['ITEMS'] = array();
}

// пагинация 
if ( ($this->arParam['show-pagination'] == 1) && !empty($arRes['ITEMS']) ) {
    
    
//    for ($i = 0; $i<30; $i++){ // TEST
//        $arRes['ITEMS'][] = $arRes['ITEMS'][0];
//    }
    
    // даст html код пагинации
    $arRes['HTML-CODE-PAGINATION'] = Pagination::getPaginationType2($arRes['ITEMS'], $this->arParam['count-news-in-1-page']);
    // отсекёт данные, что бы осталось только на текущию страницу
    $arRes['ITEMS'] = Pagination::getDataFrom1Page($arRes['ITEMS'], $this->arParam['count-news-in-1-page']);
    
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
