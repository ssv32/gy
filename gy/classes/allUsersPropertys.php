<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

/**
 * allUsersPropertys - класс для работы с общими свойствами пользователей
 */
class allUsersPropertys{
    
    private static $tableNameCreatePropertys = 'create_all_users_property';
    private static $tableNameTypePropertys = 'type_all_user_propertys';
    //private static $tableNameValuePropertyText = 'value_all_user_propertys_text';
    
    private static $tableNameTypePropertysForCodeTypeProperty = array(
        'text' => 'value_all_user_propertys_text'
    );
    
    // получить все созданные пользовательские свойства
    public static function getAllUsersPropertys(){
        global $db;		        
        $res = $db->selectDb( 
            self::$tableNameCreatePropertys, 
            array('*'),
            array(
                
            )
        );
        $result = $db->fetchAll($res, 'id');
        return $result;
    }
    
    // получить все возможные типы пользовательских свойств
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
    
    // создать пользовательское свойсто передать(имя, тип, код)
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
    
    // удалить общее пользовательское свойсто
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
        
        
        //  TODO + удалить значения
        
        return $result;
    }
    
    // взять все значения определённого типа свойства пользователя
    public static function getAllValueUserProperty($idUser, $typeCode){
        $result = false;
        
        if(!empty(self::$tableNameTypePropertysForCodeTypeProperty[$typeCode])){
            global $db;		        
            $res = $db->selectDb( 
                self::$tableNameTypePropertysForCodeTypeProperty[$typeCode], 
                array('*'),
                array()
            );
            $result = $db->fetchAll($res, 'id_property');
        }
        
        return $result;
    }
    
    // удалить значения конкретного свойства конкретного пользователя
    
    // изменить значение конкретного свойства конкретного пользователя
    
}
