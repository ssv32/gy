<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

class containerData{            
    public static $table_container_data = 'container_data';
    public static $table_list_propertys_container_data = 'list_propertys_container_data';
    public static $table_types_property_container_data = 'types_property_container_data'; 
    public static $table_element_container_data = 'element_container_data';
    public static $table_value_propertys_type_html = 'value_propertys_type_html';
    public static $table_value_propertys_type_number = 'value_propertys_type_number';
    
    public static $propertyTapleProperty = array(
        'id_type_property',
        'id_container_data',
        'code',
        'name'
    );
    
    /**
     * getContainerData - получить по фильтру ContainerData
     * @param type $arFilter
     * @param type $arProperty
     * @return array
     */
    public static function getContainerData($arFilter, $arProperty){
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_container_data,
            $arProperty,
            $arFilter
        );
                      
        $result = $db->fetchAll($res, false);
        
        return $result;
    }
    
    /**
     * addContainerData - добавить ContainerData
     * @return boolean
     */
    public static function addContainerData($arParams){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->insertDb(self::$table_container_data, $arParams);
        
        if ($res){
			$result = true;
		}
			
		return $result;
    }
    
    /**
     * deleteContainerData - удалить ContainerData
     * @global type $db
     * @param type $arParams
     * @return boolean
     */
    public static function deleteContainerData($id){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->deleteDb(self::$table_container_data, array('=' => array('id', $id)));
        
        if ($res){
            
            //нужно удалить все элементы связанные с ним свойства и значения свойств
            
            $db->deleteDb( // удалить значения свойств свойств html
                self::$table_value_propertys_type_html, 
                array('=' => array('id_container_data', $id) )  
            );
            $db->deleteDb( // удалить значения свойств свойств number
                self::$table_value_propertys_type_number, 
                array('=' => array('id_container_data', $id) )  
            );
            
            
            $db->deleteDb( // удалить элементы container-data
                self::$table_element_container_data, 
                array('=' => array('id_container_data', $id) )  
            );       
              
            $db->deleteDb( // удалить свойства container-data
                self::$table_list_propertys_container_data, 
                array('=' => array('id_container_data', $id) )  
            );
            
			$result = true;
		}
			
		return $result; 
    }
    
    /**
     * deleteContainerData - удалить ContainerData
     * @global type $db
     * @param type $arParams
     * @return boolean
     */
    public static function updateContainerData($arParams, $where){
        $result = false;

		global $db;		
        $res = $db->updateDb(self::$table_container_data, $arParams, $where);
        
        if ($res){
			$result = true;
		}
			
		return $result; 
    }
    
    
    /**
     * getAllTypePropertysContainerData - получить все типы свойств ContainerData 
     * @return array
     */
    public static function getAllTypePropertysContainerData(){
       
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_types_property_container_data,
            array('*'),
            array()
        );
              
        $result = $db->fetchAll($res);
        
        return $result;
    }
       
    /**
     * getAllPropertysContainerData - получить свойства ContainerData (! не значения)
     * @return array
     */
    public static function getPropertysContainerData($where){
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_list_propertys_container_data,
            array('*'),
            $where
        );
        
        $result = $db->fetchAll($res);
        
        return $result;
    }
    
    /**
     * addPropertyContainerData - добавить свойство для ContainerData
     * @param type $arParams
     * @return boolean
     */
    public static function addPropertyContainerData($arParams){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->insertDb(self::$table_list_propertys_container_data, $arParams);
        
        if ($res){
			$result = true;
		}
			
		return $result;
    
    }
    
    
    /**
     * getValuePropertysContainerData - получить значения свойств указанного элемента ContainerData
     * @param type $idContainerData
     * @param type $idElementContainerData
     * @param type $idProperty
     * @param type $tableName
     * @return array
     */
    public static function getValuePropertysContainerData($idContainerData, $idElementContainerData, $idProperty,  $tableName){
        $result = array();
        global $db;
        $res = $db->selectDb(
            $tableName,
            array('*'),
            array(
                'AND' => array(
                    '=' => array(
                        'id_container_data', 
                        $idContainerData
                    ),
                    'AND' => array( 
                        'AND' => array(
                            '=' => array( 
                                'id_element_container_data',
                                $idElementContainerData
                            ), 
                            'AND' => array(
                                '=' => array(
                                    'id_property_container_data', 
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
     * addValuePropertyContainerData - добавить значения свойства для элемента ContainerData
     * @param int $idContainerData
     * @param int $idElementContainerData
     * @param int $idProperty
     * @param int $tableName
     * @param mixed $value
     * @return boolean
     */
    public static function addValuePropertyContainerData($idContainerData, $idElementContainerData, $idProperty,  $tableName, $value){
        $result = false;
        global $db;		
        $res = $db->insertDb(
            $tableName, 
            array(
                'id_container_data' => $idContainerData,
                'id_element_container_data' => $idElementContainerData,
                'id_property_container_data' => $idProperty,
                'value' => $value
            )
        );
        if($res){
            $result = true;
        }
        return $result;
    }
    
    /**
     * UpdateValuePropertyContainerData - обновить значение свойства элемента container-data
     * @global type $db
     * @param type $tableName
     * @param type $id
     * @param type $value
     * @return boolean
     */
    public static function UpdateValuePropertyContainerData($tableName, $id, $value){
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
     * getAllElementContainerData - получить все элементы ContainerData
     * @param int $idContainerData
     * @return array
     */
    public static function getAllElementContainerData($idContainerData){
                      
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_element_container_data,
            array('*'),
            array(
                '=' => array('id_container_data', $idContainerData )
            )
        );
                     
        $result = $db->fetchAll($res, false);
        
        return $result;
    }
    
    /**
     * getElementContainerData - получить элемент ContainerData
     * @param int $idContainerData
     * @return array
     */
    public static function getElementContainerData($where){
                      
        $result = array();
        global $db;
        $res = $db->selectDb(
            self::$table_element_container_data,
            array('*'),
            $where
        );
                     
        $result = $db->fetch($res, false);
        
        return $result;
    }
    
    
    /**
     * addElementContainerData - добавить элемент ContainerData
     * @param type $arParams
     * @return boolean
     */
    public static function addElementContainerData($arParams){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->insertDb(self::$table_element_container_data, $arParams);
        
        if ($res){
			$result = true;
		}
			
		return $result;
    }
    
    /**
     * deleteElementContainerData - удалить элемент ContainerData
     * @param type $arParams
     * @return boolean
     */
    public static function deleteElementcContainerData($id){
        $result = false;

		global $db;		
        $res = $db->deleteDb(self::$table_element_container_data, array('=' => array('id', $id)));
        
        if ($res){
            // надо удалить все свойства этого элемента
            $db->deleteDb( // удалить всё для свойств html
                self::$table_value_propertys_type_html, 
                array('=' => array('id_element_container_data', $id) )  
            );
            $db->deleteDb( // удалить всё для свойств number
                self::$table_value_propertys_type_number, 
                array('=' => array('id_element_container_data', $id) )  
            );
        
                    
			$result = true;
		}
			
		return $result;
    }
    
    /**
     * updateElementContainerData - зменить элемент ContainerData
     * @param type $arParams
     * @return boolean
     */
    public static function updateElementContainerData($arParams, $where){
        $result = false;

		// id, login, name, pass, groups
		global $db;		
        $res = $db->updateDb(self::$table_element_container_data, $arParams, $where);
        
        if ($res){
			$result = true;
		}
			
		return $result;
    }
    
    /** //TODO протестить закомментировать
     * deletePropertyContainerData - удалить свойства инфоблока
     * @param int $idProperty - id свойства container-data
     * @param int $containerData
     * @return boolean
     */
    public static function deletePropertyContainerData($idProperty, $containerData){
        //---надо взять все имеющиеся для этого свойства значения у элементов и удалить тоже
        global $db;	
        
        // взять все типы инфоблоков что бы знать в каких таблицах искать значения
        $dataTypeProperty = containerData::getAllTypePropertysContainerData();
        
        // найти все свойства container-data      
        $propertyContainerData = containerData::getPropertysContainerData(
            array(
                '='=>array(
                    'id_container_data', 
                    $containerData
                ) 
            ) 
        );
        
        $tableName = $dataTypeProperty[$propertyContainerData[$idProperty]['id_type_property']]['name_table'];
        
        // удалить для всех элементов значения свойства           
        $db->deleteDb($tableName, array('=' => array('id_property_container_data', $idProperty) )  );
        
        // удалить само свойство container-data
        $db->deleteDb(static::$table_list_propertys_container_data, array('=' => array('id', $idProperty) )  );

        ////---
        return true; // TODO доделать что бы был ещё false
    }
       
    
}