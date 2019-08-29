<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$arRes = array();

$data = $_POST;

// удаления свойства info-box
if(!empty($data['del-property-id']) && !empty($data['del-proprty-info-box']) ){
    infoBox::deletePropertyInfoBox( $data['del-property-id'], $data['del-proprty-info-box']);
    $arRes['status'] = 'del-property-ok';
}else{


    $arRes['TYPE_PROPERTYS'] = infoBox::getAllTypePropertysInfoBox();

    if(!empty($data)){

        if( !empty($data['type_property']) && ($data['type_property'] != 'null') && !empty($arRes['TYPE_PROPERTYS'][$data['type_property']]) ){
            if( !empty($data['name']) && !empty($data['code']) ){

                $res = infoBox::addPropertyInfoBox( 
                    array(
                        'id_type_property' => $data['type_property'],
                        'id_info_box' => $this->arParam['info-box-id'],
                        'code' => $data['code'],
                        'name' => $data['name']
                    )
                );

                if($res){
                    $arRes['status'] = 'add-ok';
                } else{
                    $arRes['status'] = 'add-err';
                }

            }else{
                $arRes['status'] = 'add-err';
            }
        }else{
            $arRes['status'] = 'add-err-not-type';
        }
    }

    // найти свойства текущего info-box
    if (!empty($this->arParam['info-box-id']) && is_numeric($this->arParam['info-box-id'])){
        $arRes['PROPERTYS'] = infoBox::getPropertysInfoBox(array('='=>array('id_info_box', $this->arParam['info-box-id'])) );
    }
}
    
// показать шаблон
$this->template->show($arRes, $this->arParam);
