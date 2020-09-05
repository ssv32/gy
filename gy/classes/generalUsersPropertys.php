<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

/**
 * generalUsersPropertys - класс для работы с общими свойствами пользователей
 */
class generalUsersPropertys{
    
    private static $tableNameCreatePropertys = 'create_all_users_property';
    private static $tableNameTypePropertys = 'type_all_user_propertys';
    
    private static $tableNameTypePropertysForCodeTypeProperty = array(
        'text' => 'value_all_user_propertys_text'
    );
    
    /**
     * getAllGeneralUsersPropertys
     *  - получить все созданные пользовательские свойства
     * 
     * @global type $db
     * @return array
     */
    public static function getAllGeneralUsersPropertys(){ 
        global $db;		        
        $res = $db->selectDb( 
            self::$tableNameCreatePropertys, 
            array('*'),
            array()
        );
        $result = $db->fetchAll($res, 'id');
        return $result;
    }
    
    /**
     * getAllTypeAllUsersPropertys 
     *  - получить все возможные типы пользовательских свойств
     * 
     * @global type $db
     * @return array
     */
    public static function getAllTypeAllUsersPropertys(){
        global $db;		        
        $res = $db->selectDb( 
            self::$tableNameTypePropertys, 
            array('*'),
            array(
                
            )
        );
        $result = $db->fetchAll($res, 'id');
        return $result;
    }
    
    /**
     * addUsersPropertys
     *  - создать пользовательское свойство
     * 
     * @global type $db
     * @param string $name - имя
     * @param int $idType - тип
     * @param string $code - код
     * @return boolean
     */
    public static function addUsersPropertys($name, $idType, $code){
        $result = false;

        global $db;		
        $res = $db->insertDb(
            self::$tableNameCreatePropertys, 
            array(
                'name_property' => $name,
                'type_property' => $idType,
                'code' => $code
            )
        );
                
        if ($res){
            $result = true;
        }		
        return $result;
    }
    
    /**
     * deleteUserProperty
     *  - удалить общее пользовательское свойство
     * 
     * @global type $db
     * @param int $id - id общего пользовательского свойства
     * @return boolean
     */
    public static function deleteUserProperty($id){
        $result = false;
        global $db;

        $res = $db->deleteDb(
            self::$tableNameCreatePropertys, 
            array('='=>array('id', $id))
        );

        if ($res){
            $result = true;		
        }
        
        //удалить значения
        self::deleteAllValuesAllUserBypropertyId($id, 'text'); // text - т.к. пока других нет
        
        return $result;
    }
    
    /**
     * deleteAllValuesAllUserBypropertyId
     *  - удалить все значения определённого свойства у всех пользователей
     * 
     * @global type $db
     * @param int $idProperty - id свойства (общее свойство)
     * @param string $typePropertyCode - пока у всех значение text
     * @return boolean
     */
    public static function deleteAllValuesAllUserBypropertyId($idProperty, $typePropertyCode){
        $result = false;
        
        if(!empty(self::$tableNameTypePropertysForCodeTypeProperty[$typePropertyCode])){
            global $db;	
            
            $res = $db->deleteDb(
                self::$tableNameTypePropertysForCodeTypeProperty[$typePropertyCode],
                array( '=' => array('id_property', $idProperty) )
            );

            if ($res){
                $result = true;		
            }
        }
        return $result;
        
    }
    
    /**
     * getAllValueUserProperty
     *  - взять все значения определённого типа свойства пользователя
     * 
     * @global type $db
     * @param int $idUser - id пользователя
     * @param string $typePropertyCode - пока у всех значение text
     * @return boolean/array
     */
    public static function getAllValueUserProperty($idUser, $typePropertyCode){
        $result = false;
        
        if(!empty(self::$tableNameTypePropertysForCodeTypeProperty[$typePropertyCode])){
            global $db;		        
            $res = $db->selectDb( 
                self::$tableNameTypePropertysForCodeTypeProperty[$typePropertyCode], 
                array('*'),
                array( '=' => array('id_users', $idUser) )
            );
            $result = $db->fetchAll($res, 'id_property');
        } 
        return $result;
    }
    
    /**
     * addValueProperty
     *  - добавить значение свойства
     * 
     * @global type $db
     * @param int $idUser - id пользователя
     * @param string $typePropertyCode - пока у всех значение text
     * @param int $idProperty - id пользовательского свойства
     * @param string $value - пока тип text, тут только строка
     * @return boolean
     */
    public static function addValueProperty($idUser, $typePropertyCode, $idProperty, $value){
        $result = false;
        
        if(!empty(self::$tableNameTypePropertysForCodeTypeProperty[$typePropertyCode])){
            global $db;
            $res = $db->insertDb(
                self::$tableNameTypePropertysForCodeTypeProperty[$typePropertyCode], 
                array(
                    'value' => $value,
                    'id_users' => $idUser,
                    'id_property' => $idProperty
                )
            );

            if ($res){
                $result = true;
            }
        }
        return $result;
    }
    
    /**
     * deleteValueProperty 
     *  - удалить значения конкретного свойства конкретного пользователя
     * 
     * @global type $db
     * @param int $idUser - id пользователя
     * @param string $typePropertyCode - пока у всех значение text
     * @param int $idProperty - id пользовательского свойства
     * @return boolean
     */
    public static function deleteValueProperty($idUser, $typePropertyCode, $idProperty){
        $result = false;
        
        if(!empty(self::$tableNameTypePropertysForCodeTypeProperty[$typePropertyCode])){
            global $db;	
            
            $res = $db->deleteDb(
                self::$tableNameTypePropertysForCodeTypeProperty[$typePropertyCode],
                array( 
                    'AND' => array(
                        array('=' => array('id_users', $idUser) ), 
                        array('=' => array('id_property', $idProperty) ) 
                    ),  
                )
            );

            if ($res){
                $result = true;		
            }
        }
        
        return $result;
    }
    
    /**
     * updateValueProperty
     *  - изменить значение конкретного свойства конкретного пользователя
     * 
     * @global type $db
     * @param int $idUser - id пользователя
     * @param string $typePropertyCode - пока у всех значение text
     * @param int $idProperty - id пользовательского свойства
     * @param string $value - пока тип text, тут только строка
     * @return boolean
     */
    public static function updateValueProperty($idUser, $typePropertyCode, $idProperty, $value){
        $result = false;
        
        if(!empty(self::$tableNameTypePropertysForCodeTypeProperty[$typePropertyCode])){
            global $db;
            $res = $db->updateDb(
                self::$tableNameTypePropertysForCodeTypeProperty[$typePropertyCode],
                array(
                    'id_users' => $idUser,
                    'id_property' => $idProperty,
                    'value' => $value
                ),
                array( 
                    'AND' => array(
                        array('=' => array('id_users', $idUser) ), 
                        array('=' => array('id_property', $idProperty) ) 
                    ),  
                )
            );

            if ($res){
                $result = true;		
            }
        }
        return $result;
    }
    
    
}
