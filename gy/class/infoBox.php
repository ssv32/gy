<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

class infoBox{            
    public $table_info_box = 'info_box';
    public $table_list_propertys_info_box = 'list_propertys_info_box';
    public $table_types_property_info_box = 'types_property_info_box'; 
    public $table_element_info_box = 'element_info_box';
    public $table_value_propertys_type_html = 'value_propertys_type_html';
    public $table_value_propertys_type_number = 'value_propertys_type_number';
    
    /**
     * getInfoBox - получить по фильтру InfoBox
     * @param type $arFilter
     * @param type $arProperty
     */
    public static function getInfoBox($arFilter, $arProperty){
        
    }
    
    /**
     * addInfoBox - добавить InfoBox
     */
    public static function addInfoBox($arParams){
        
    }
    
    /**
     * getAllTypePropertysInfoBox - получить все типы свойств InfoBox 
     */
    public static function getAllTypePropertysInfoBox(){
        echo 'getAllTypePropertysInfoBox - ok';
    }
       
    /**
     * getAllPropertysInfoBox - получить свойства InfoBox (! не значения)
     */
    public static function getAllPropertysInfoBox($idInfoBox){
        
    }
    
    /**
     * addPropertyInfoBox - добавить свойство для InfoBox
     * @param type $arParams
     */
    public static function addPropertyInfoBox($arParams){
        
    }
    
    /**
     * getValuePropertysInfoBox - получить значения свойств указанного элемента infoBox
     * @param type $idInfoBox
     * @param type $idElementInfoBox
     * @param type $tableName
     */
    public static function getValuePropertysInfoBox($idInfoBox, $idElementInfoBox, $tableName){
        
    }
    
    /**
     * addValuePropertyInfoBox - добавить значения свойства для элемента InfoBox
     * @param type $arParams
     */
    public static function addValuePropertyInfoBox($arParams){
        
    }
    
    /**
     * getAllElementInfoBox - получить все элементы InfoBox
     * @param type $idInfoBox
     */
    public static function getAllElementInfoBox($idInfoBox){
        
    }
    
    /**
     * addElementInfoBox - добавить элемент InfoBox
     * @param type $arParams
     */
    public static function addElementInfoBox($arParams){
        
    }
    
}
