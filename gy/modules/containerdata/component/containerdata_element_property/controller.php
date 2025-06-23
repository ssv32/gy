<?php 

use Gy\Modules\containerdata\Classes\ContainerData;

if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$data = $_REQUEST;
$arRes = array();

global $APP;
$arRes['THIS-PAGE-URL'] = '?page='.$data['page'].'&container-data-id='.$data['container-data-id'].'&el-id='.$data['el-id']; // $APP->getAllUrlTisPage();

if (!empty($this->arParam['container-data-id']) && !empty($this->arParam['el-id'])) {
    // получить свойства container-data
    $arRes['PROPERTY'] = ContainerData::getPropertysContainerData( array('='=>array('id_container_data', $this->arParam['container-data-id'])) );
    
    // получить все типы свойств
    $arRes['PROPERTY_TYPE'] = ContainerData::getAllTypePropertysContainerData();

    

    // сохранить файлы // TODO тут надо проверить прова пользователя + потестить безопасность (что бы не удалялся произвольный файл)
    if (!empty($_FILES['propertyAdd']['tmp_name'])){
        foreach ($_FILES['propertyAdd']['tmp_name'] as $key => $val) {
            global $APP;
            if (($val != '') && move_uploaded_file($val, $APP->urlProject.'/'.$APP->options['dir_public_file'].'/'.$_FILES['propertyAdd']['name'][$key] ) ) {
                $data['propertyAdd'][$key] = '/'.$APP->options['dir_public_file'].'/'.$_FILES['propertyAdd']['name'][$key];
            }
        }
    }
    
    // сохранение свойств
    if (!empty($data['propertyAdd'])) {
        
        foreach ($data['propertyAdd'] as $key => $val) {
            $res = ContainerData::addValuePropertyContainerData(
                $this->arParam['container-data-id'], 
                $this->arParam['el-id'], 
                $key,  
                $arRes['PROPERTY_TYPE'][$arRes['PROPERTY'][$key]['id_type_property']]['name_table'],
                $val
            );
            if ($res) {
                $arRes['stat-save'] = 'ok';
            }
            
        }
    }

    $arRes['PROPERTY_VALUE'] = array();

    // получить значения
    if (!empty($arRes['PROPERTY']) && is_array($arRes['PROPERTY'])) {
        foreach ($arRes['PROPERTY'] as $key => $val) {
            $propertyValue = ContainerData::getValuePropertysContainerData(
                $this->arParam['container-data-id'], 
                $this->arParam['el-id'],
                $val['id'],
                $arRes['PROPERTY_TYPE'][$val['id_type_property']]['name_table']
            );

            if (!empty($propertyValue)) {
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
    if (!empty($data['propertyUpdate'])) {
        
        foreach ($data['propertyUpdate'] as $key => $val) {

            if ($arRes['PROPERTY_TYPE'][$arRes['PROPERTY'][$arKeyValue[$key]]['id_type_property']]['code'] == 'file') { // если файл удаляется , удалить его из раздела
                global $APP;
                if (unlink($APP->urlProject.$arRes['PROPERTY_VALUE'][$arKeyValue[$key]]['value']) ){
                    
                    $res = ContainerData::deleteValuePropertyContainerData(
                        $arRes['PROPERTY_TYPE'][$arRes['PROPERTY'][$arKeyValue[$key]]['id_type_property']]['name_table'],
                        $key   
                    );
                    
                } else {
                    $res = false;
                }
            } else {
                $res = ContainerData::updateValuePropertyContainerData(
                    $arRes['PROPERTY_TYPE'][$arRes['PROPERTY'][$arKeyValue[$key]]['id_type_property']]['name_table'],
                    $key,
                    $val
                );
            } 

            if ($res) {
                $arRes['stat-save'] = 'ok';
            }

        }
    }

    // TODO заменить повторный код на редирект
    $arRes['PROPERTY_VALUE'] = array();

    // получить значения
    if (!empty($arRes['PROPERTY']) && is_array($arRes['PROPERTY'])) {
        foreach ($arRes['PROPERTY'] as $key => $val) {
            $propertyValue = ContainerData::getValuePropertysContainerData(
                $this->arParam['container-data-id'],
                $this->arParam['el-id'],
                $val['id'],
                $arRes['PROPERTY_TYPE'][$val['id_type_property']]['name_table']
            );

            if (!empty($propertyValue)) {
                $arRes['PROPERTY_VALUE'][$val['id']] = $propertyValue;
            }
        }
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
