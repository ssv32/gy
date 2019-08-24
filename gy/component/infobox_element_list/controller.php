<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$arRes = array();

$data = $_REQUEST;

if (!empty($data['id_info_box']) && !empty($data['name']) && !empty($data['code']) ){
    
    if(empty($data['el-id'])){ // добавить новый элемент info-box
        $res = infoBox::addElementInfoBox(
            array(
                'section_id' => $data['section_id'],
                'name' => $data['name'],
                'code' => $data['code'],
                'id_info_box' => $data['id_info_box']
            )
        );
        if($res){ 
            $arRes['stat'] = 'ok';
        }else{
            $arRes['stat'] = 'err';
        }
        
    }elseif(!empty($data['el_edit_id']) && is_numeric($data['el_edit_id'])){ // изменить элемент info-box
        
        
        $res = infoBox::updateElementInfoBox(
            array(
                'section_id' => $data['section_id'],
                'name' => $data['name'],
                'code' => $data['code'],
                'id_info_box' => $data['id_info_box']
            ),
            array(
                '=' =>array('id', $data['el_edit_id'])
            )
        );
        
        if($res){ 
            $arRes['stat-edit'] = 'ok';
        }else{
            $arRes['stat-edit'] = 'err';
        }
    }else{
        $arRes['stat'] = 'err';
    }  
    
}

if( !empty($data['del-el']) && !empty($data['id']) ){
    $res = infoBox::deleteElementInfoBox( $data['id']);
    if($res){ 
        $arRes['stat-del'] = 'ok';
    }else{
        $arRes['stat-del'] = 'err';
    }
}

if (!empty($this->arParam['info-box-id']) && is_numeric($this->arParam['info-box-id'])){
    $arRes['ITEMS'] = infoBox::getAllElementInfoBox($this->arParam['info-box-id']);
      
    if(!empty($data['el-id']) && is_numeric($data['el-id']) && empty($arRes['stat-edit']) ){
        
        foreach ($arRes['ITEMS'] as $val){
            if($val['id'] == $data['el-id']){
                $arRes['stat-del'] = 'edit';
                $arRes['edit-id'] = $data['el-id'];
                $arRes['edit-el-data'] = $val;
            }
        }
    }
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
