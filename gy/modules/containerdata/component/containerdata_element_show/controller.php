<?php 

use Gy\Modules\containerdata\Classes\ContainerData;

if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$arRes = array();

// TODO попробовать уменьшить количество запросов

/**
* container-data-code код container-data
* element-code - code элемента
*/
if (!empty($this->arParam['container-data-code']) && !empty($this->arParam['element-code'])) {

    $isCache = (!empty($this->arParam['cacheTime']) && is_numeric($this->arParam['cacheTime']));

    if ($isCache) {
        global $APP;
        global $CACHE_CLASS_NAME;
        $cache = new $CACHE_CLASS_NAME($APP->url);
        $initCache = $cache->cacheInit('component_container_data_element_show', $this->arParam['cacheTime']);
    }

    if ($isCache && $initCache) {
        $arRes = $cache->getCacheData();
    }

    if (!$isCache || ($isCache && !$initCache)) {

        // найти container-data
        $dataContainerData = ContainerData::getContainerData(
            array(
                '=' => array( 'code', "'".$this->arParam['container-data-code']."'")
            ),
            array('*')
        );

        $dataContainerData = $dataContainerData[0];

        // взять типы свойств что бы знать названия таблиц где их искать
        $dataTypeProperty = ContainerData::getAllTypePropertysContainerData();

        // найти его свойства
        $propertyContainerData = ContainerData::getPropertysContainerData(
            array(
                '='=>array(
                    'id_container_data',
                    $dataContainerData['id']
                )
            )
        );

        // найти элемент
        $dataElement = ContainerData::getElementContainerData(
            array(
                'AND' => array(
                    array( '=' => array( 'id_container_data', $dataContainerData['id'])),
                    array( '=' => array( 'code', "'".$this->arParam['element-code']."'"))
                )
            )
        );

        // найти значения свойств элемента
        $arRes['ITEMS'] = array();

        foreach ($propertyContainerData as $val) {
            $arRes['ITEMS'][$val['id']] = ContainerData::getValuePropertysContainerData(
                $dataContainerData['id'],
                $dataElement['id'],
                $val['id'],
                $dataTypeProperty[$val['id_type_property']]['name_table']
            );
        }

        if ($isCache) {
            $cache->setCacheData($arRes);
        }
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
