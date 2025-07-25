<?php 

use Gy\Modules\containerdata\Classes\ContainerData;

if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$arRes = array();

$data = $_POST;

// удаления свойства container-data
if (!empty($data['del-property-id']) && !empty($data['del-proprty-container-data'])) {
    ContainerData::deletePropertyContainerData( $data['del-property-id'], $data['del-proprty-container-data']);
    $arRes['status'] = 'del-property-ok';
}else{

    $arRes['TYPE_PROPERTYS'] = ContainerData::getAllTypePropertysContainerData();

    if (!empty($data)) {

        if (!empty($data['type_property']) && ($data['type_property'] != 'null') && !empty($arRes['TYPE_PROPERTYS'][$data['type_property']])) {
            if (!empty($data['name']) && !empty($data['code'])) {

                $res = ContainerData::addPropertyContainerData( 
                    array(
                        'id_type_property' => $data['type_property'],
                        'id_container_data' => $this->arParam['container-data-id'],
                        'code' => $data['code'],
                        'name' => $data['name']
                    )
                );

                if ($res) {
                    $arRes['status'] = 'add-ok';
                } else {
                    $arRes['status'] = 'add-err';
                }

            } else {
                $arRes['status'] = 'add-err';
            }
        } else {
            $arRes['status'] = 'add-err-not-type';
        }
    }

    // найти свойства текущего container-data
    if (!empty($this->arParam['container-data-id']) && is_numeric($this->arParam['container-data-id'])) {
        $arRes['PROPERTYS'] = ContainerData::getPropertysContainerData(array('='=>array('id_container_data', $this->arParam['container-data-id'])) );
    }
}

// если детальная страница добавим в хлебные крошки
if (!empty($this->arParam['show-bread-crumbs']) 
    && ($this->arParam['show-bread-crumbs'] == 1) 
    && !empty($this->arParam['container-data-id'])
) {
    $info = ContainerData::getContainerData(array( '=' =>array( 'id', $this->arParam['container-data-id'])), array('*') );
    $this->arParam['bread-crumbs-items'][] = 'Редактировать свойства этого контейнера данных - '.$info[0]['name'];
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
