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
     * @return array
     */
    public static function getInfoBox($arFilter, $arProperty){
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_info_box,
            $arProperty,
            $arFilter
        );
                      
        $result = $db->fetchAll($res, false);
        
        return $result;
    }
    
    /**
     * addInfoBox - добавить InfoBox
     * @return boolean
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
     * @return array
     */
    public static function getAllTypePropertysInfoBox(){
       
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_types_property_info_box,
            array('*'),
            array()
        );
              
        $result = $db->fetchAll($res);
        
        return $result;
    }
       
    /**
     * getAllPropertysInfoBox - получить свойства InfoBox (! не значения)
     * @return array
     */
    public static function getPropertysInfoBox($where){
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_list_propertys_info_box,
            array('*'),
            $where
        );
        
        $result = $db->fetchAll($res);
        
        return $result;
    }
    
    /**
     * addPropertyInfoBox - добавить свойство для InfoBox
     * @param type $arParams
     * @return boolean
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
     * @param type $idProperty
     * @param type $tableName
     * @return array
     */
    public static function getValuePropertysInfoBox($idInfoBox, $idElementInfoBox, $idProperty,  $tableName){
        $result = array();
        global $db;
        $res = $db->selectDb(
            $tableName,
            array('*'),
            array(
                'AND' => array(
                    '=' => array(
                        'id_info_box', 
                        $idInfoBox 
                    ),
                    'AND' => array( 
                        'AND' => array(
                            '=' => array( 
                                'id_element_info_box',
                                $idElementInfoBox
                            ), 
                            'AND' => array(
                                '=' => array(
                                    'id_property_info_box', 
                                    $idProperty
                                ) 
                            )    
                        )
                    )
                )    
            )
        );
                      
        if ($arRes = $db->fetch($res)){
			$result = $arRes;
		}
        return $result;
    }
    
    /**
     * addValuePropertyInfoBox - добавить значения свойства для элемента InfoBox
     * @param int $idInfoBox
     * @param int $idElementInfoBox
     * @param int $idProperty
     * @param int $tableName
     * @param mixed $value
     * @return boolean
     */
    public static function addValuePropertyInfoBox($idInfoBox, $idElementInfoBox, $idProperty,  $tableName, $value){
        $result = false;
        global $db;		
        $res = $db->insertDb(
            $tableName, 
            array(
                'id_info_box' => $idInfoBox,
                'id_element_info_box' => $idElementInfoBox,
                'id_property_info_box' => $idProperty,
                'value' => $value
            )
        );
        if($res){
            $result = true;
        }
        return $result;
    }
    
    /**
     * UpdateValuePropertyInfoBox - обновить значение свойства элемента info-box
     * @global type $db
     * @param type $tableName
     * @param type $id
     * @param type $value
     * @return boolean
     */
    public static function UpdateValuePropertyInfoBox($tableName, $id, $value){
        $result = false;
        global $db;
        
        $res = $db->updateDb(
            $tableName, 
            array('value' => $value), 
            array(
                '=' => array('id', $id)
            )
        );
        
        if($res){
            $result = true;
        }
        return $result;
    }  
    
    /**
     * getAllElementInfoBox - получить все элементы InfoBox
     * @param int $idInfoBox
     * @return array
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
                     
        $result = $db->fetchAll($res, false);
        
        return $result;
    }
    
    /**
     * getElementInfoBox - получить элемент InfoBox
     * @param int $idInfoBox
     * @return array
     */
    public static function getElementInfoBox($where){
                      
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_element_info_box,
            array('*'),
            $where
        );
                     
        $result = $db->fetch($res, false);
        
        return $result;
    }
    
    
    /**
     * addElementInfoBox - добавить элемент InfoBox
     * @param type $arParams
     * @return boolean
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
     * @return boolean
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
    
    /**
     * updateElementInfoBox - зменить элемент InfoBox
     * @param type $arParams
     * @return boolean
     */
    public static function updateElementInfoBox($arParams, $where){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->updateDb(self::$table_element_info_box, $arParams, $where);
        
        if ($res){
			$result = true;
		}
			
		return $result;
    }
    
}
