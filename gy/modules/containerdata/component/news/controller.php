<?php

use Gy\Modules\containerdata\Classes\ContainerData;

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
'cacheTime' => 86400, // TODO
        'count-news-in-1-page' => 2, // TODO сколько новостей на 1 странице
        'show-pagination' => 1, // TODO 1/0
        'show-property-news' => array( // TODO
            'detailed_text',
            'preview_text'
        ),
        'show-in-url-code' => 1, // TODO 1/0 чпу
*/

// TODO проверить правельность данных пришедших от вызова компонента и пагинации

if ($flagTrueContainerDataId){
    // TODO это быстрое решение берётся всё сразу, для мелкого проекта норм, но можно брать только то что нужно
    $arRes['ITEMS'] = ContainerData::getAllElementContainerData($this->arParam['container-data-id']);

    // получить свойства container-data
    $arRes['PROPERTY'] = ContainerData::getPropertysContainerData( array('='=>array('id_container_data', $this->arParam['container-data-id'])) );
    
    foreach ($arRes['PROPERTY'] as $key=> $value) {
        if (!in_array($value['code'], $this->arParam['show-property-news'])) {
            unset($arRes['PROPERTY'][$key]);
        }
    }
    
    // получить все типы свойств
    $arRes['PROPERTY_TYPE'] = ContainerData::getAllTypePropertysContainerData();
    
    // получить значения //TODO слишком много запросов, переделать бы
    if (!empty($arRes['PROPERTY']) && is_array($arRes['PROPERTY'])) {
        foreach ($arRes['ITEMS'] as $key0 => $valueElement) {
            
            foreach ($arRes['PROPERTY'] as $key => $val) {
                $arRes['ITEMS'][$key0]['property'][$val['code']] = $val;
                
                $propertyValue = ContainerData::getValuePropertysContainerData(
                    $this->arParam['container-data-id'],
                    $valueElement['id'],
                    $val['id'],
                    $arRes['PROPERTY_TYPE'][$val['id_type_property']]['name_table']
                );

                if (!empty($propertyValue)) {
                    
                    $arRes['ITEMS'][$key0]['property'][$val['code']]['value'] = $propertyValue;
                }
            }
            
        }
    }
 
} else {
    $arRes['ITEMS'] = array();
}

// пагинация // TODO добавить стрелки навигации < ... >, и все не выводить страницы сразу 
if ( ($this->arParam['show-pagination'] == 1) && !empty($arRes['ITEMS']) ) {
    $namePage = 'page'; // что будет в урле page=1, =2 ...
    
    $thisPage = $data[$namePage];
    if ($thisPage <= 0){
        $thisPage = 1;
    }
    
    $count = count($arRes['ITEMS']);
    $allPages = ceil(count($arRes['ITEMS']) / $this->arParam['count-news-in-1-page']); 
    
    $arRes['ITEMS'] = array_slice($arRes['ITEMS'], (($thisPage * $this->arParam['count-news-in-1-page']) - $this->arParam['count-news-in-1-page']), $this->arParam['count-news-in-1-page']);
//    $arRes['THIS-PAGE'] = $thisPage;
//    $arRes['ALL-PAGE'] = $allPages;
//    $arRes['text-n-page-in-url'] = $namePage;
    
    $htmlCodePagination = '';
    for ($i =1; $i <= $allPages; $i++){
        $active1 = '<a href="?'.$namePage.'='.$i.'">';
        $active2 = '</a>';
        if ($thisPage == $i) {
            $active1 = '(';
            $active2 = ')';
        }
        $htmlCodePagination .= $active1.$i.$active2.' ';
    }
            
    $arRes['HTML-CODE-PAGINATION'] = $htmlCodePagination;
    
}



// показать шаблон
$this->template->show($arRes, $this->arParam);
