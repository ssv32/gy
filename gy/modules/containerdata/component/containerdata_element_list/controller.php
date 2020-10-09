<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

$arRes = array();

$data = $_REQUEST;

if (!empty($data['id_container_data']) && !empty($data['name']) && !empty($data['code'])) {
    
    if (empty($data['el-id'])) { // добавить новый элемент container-data
        $res = ContainerData::addElementContainerData(
            array(
                'section_id' => $data['section_id'],
                'name' => $data['name'],
                'code' => $data['code'],
                'id_container_data' => $data['id_container_data']
            )
        );
        if ($res) { 
            $arRes['stat'] = 'ok';
        } else {
            $arRes['stat'] = 'err';
        }
        
    } elseif (!empty($data['el_edit_id']) && is_numeric($data['el_edit_id'])) { // изменить элемент container-data
        
        
        $res = ContainerData::updateElementContainerData(
            array(
                'section_id' => $data['section_id'],
                'name' => $data['name'],
                'code' => $data['code'],
                'id_container_data' => $data['id_container_data']
            ),
            array(
                '=' =>array('id', $data['el_edit_id'])
            )
        );
        
        if ($res) { 
            $arRes['stat-edit'] = 'ok';
        } else {
            $arRes['stat-edit'] = 'err';
        }
    } else {
        $arRes['stat'] = 'err';
    }  
    
}

if (!empty($data['del-el']) && !empty($data['id'])) {
    $res = ContainerData::deleteElementContainerData( $data['id']);
    if ($res) { 
        $arRes['stat-del'] = 'ok';
    } else {
        $arRes['stat-del'] = 'err';
    }
}

if (!empty($this->arParam['container-data-id']) && is_numeric($this->arParam['container-data-id'])) {
    $arRes['ITEMS'] = ContainerData::getAllElementContainerData($this->arParam['container-data-id']);
      
    if (!empty($data['el-id']) && is_numeric($data['el-id']) && empty($arRes['stat-edit'])) {
        
        foreach ($arRes['ITEMS'] as $val) {
            if ($val['id'] == $data['el-id']) {
                $arRes['stat-del'] = 'edit';
                $arRes['edit-id'] = $data['el-id'];
                $arRes['edit-el-data'] = $val;
            }
        }
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
