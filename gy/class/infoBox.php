<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

class infoBox{            
    public static $table_info_box = 'info_box';
    public static $table_list_propertys_info_box = 'list_propertys_info_box';
    public static $table_types_property_info_box = 'types_property_info_box'; 
    public static $table_element_info_box = 'element_info_box';
    public static $table_value_propertys_type_html = 'value_propertys_type_html';
    public static $table_value_propertys_type_number = 'value_propertys_type_number';
    
    public static $propertyTapleProperty = array(
        'id_type_property',
        'id_info_box',
        'code',
        'name'
    );
    
    /**
     * getInfoBox - получить по фильтру InfoBox
     * @param type $arFilter
     * @param type $arProperty
     */
    public static function getInfoBox($arFilter, $arProperty){
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_info_box,
            $arProperty,
            $arFilter
        );
              
        while ($arRes = $db->GetResult_fetch_assoc($res)){
			$result[] = $arRes;
		}
        return $result;
    }
    
    /**
     * addInfoBox - добавить InfoBox
     */
    public static function addInfoBox($arParams){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->insertDb(self::$table_info_box, $arParams);
        
        if ($res){
			$result = true;
		}
			
		return $result;
    }
    
    /**
     * deleteInfoBox - удалить InfoBox
     * @global type $db
     * @param type $arParams
     * @return boolean
     */
    public static function deleteInfoBox($arParams){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->deleteDb(self::$table_info_box, $arParams);
        
        if ($res){
			$result = true;
		}
			
		return $result; 
    }
    
    /**
     * deleteInfoBox - удалить InfoBox
     * @global type $db
     * @param type $arParams
     * @return boolean
     */
    public static function updateInfoBox($arParams, $where){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->updateDb(self::$table_info_box, $arParams, $where);
        
        if ($res){
			$result = true;
		}
			
		return $result; 
    }
    
    
    /**
     * getAllTypePropertysInfoBox - получить все типы свойств InfoBox 
     */
    public static function getAllTypePropertysInfoBox(){
       
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_types_property_info_box,
            array('*'),
            array()
        );
              
        while ($arRes = $db->GetResult_fetch_assoc($res)){
			$result[$arRes['id']] = $arRes;
		}
        return $result;
    }
       
    /**
     * getAllPropertysInfoBox - получить свойства InfoBox (! не значения)
     */
    public static function getPropertysInfoBox($where){
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_list_propertys_info_box,
            array('*'),
            $where
        );
              
        while ($arRes = $db->GetResult_fetch_assoc($res)){
			$result[] = $arRes;
		}
        return $result;
    }
    
    /**
     * addPropertyInfoBox - добавить свойство для InfoBox
     * @param type $arParams
     */
    public static function addPropertyInfoBox($arParams){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->insertDb(self::$table_list_propertys_info_box, $arParams);
        
        if ($res){
			$result = true;
		}
			
		return $result;
    
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
                      
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_element_info_box,
            array('*'),
            array(
                '=' => array('id_info_box', $idInfoBox )
            )
        );
              
        while ($arRes = $db->GetResult_fetch_assoc($res)){
			$result[] = $arRes;
		}
        return $result;
    }
    
    /**
     * addElementInfoBox - добавить элемент InfoBox
     * @param type $arParams
     */
    public static function addElementInfoBox($arParams){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->insertDb(self::$table_element_info_box, $arParams);
        
        if ($res){
			$result = true;
		}
			
		return $result;
    }
    
    /**
     * deleteElementInfoBox - удалить элемент InfoBox
     * @param type $arParams
     */
    public static function deleteElementInfoBox($id){
        $result = false;

		global $db;		
        $res = $db->deleteDb(self::$table_element_info_box, array('=' => array('id', $id)));
        
        if ($res){
			$result = true;
		}
			
		return $result;
    }
    
}
