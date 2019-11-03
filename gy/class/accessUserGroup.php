<?php
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

/**
 * accessUserGroup - будет всё что связано с правами доступов пользователей 
 * (и групп пользователей)
 */
class accessUserGroup{
    
    private static $tableNameAccessGroup = 'access_group';
    private static $tableNameUserActions = 'action_user';
    private static $tableNameUsersInGroupss = 'users_in_groups';
    
    
    /**
     * accessUser() - проверит разрешёно ли указанное действие заданному пользователю
     * 
     * @param int $userId - id пользователя
     * @param string $actionUser - код пользовательского дефствия
     * @return boolean
     */
    public static function accessUser($userId, $actionUser){
        /*
        1. получить все группы и права для них
        2. получить группы в каких состоит заданный пользователь
        3. выдать разрешён ли доступ или нет 

        */
        
        return true;
    }
    
    /**
     * getAccessGroup() - получить все группы пользователей какие есть
     *  + вернутся заданные в группах разрешения на пользовательские действия
     * @return array
     */
    public static function getAccessGroup(){ // TODO закешировать
        $arResult = array();
        
        global $db;
        $res = $db->selectDb(self::$tableNameAccessGroup, array('*'));
        while($arRes = $db->fetch($res)){
            $arResult[$arRes['code']]['code_action_user'][$arRes['code_action_user']] = $arRes['code_action_user'];
            $arResult[$arRes['code']]['name'] = $arRes['name'];
            $arResult[$arRes['code']]['code'] = $arRes['code'];
            $arResult[$arRes['code']]['text'] = $arRes['text'];
        }
        
        return $arResult;
    }
    
    /**
     * getUserAction() - получить все какие есть пользовательские действия
     * @return array
     */
    public static function getUserAction(){ // TODO закешировать
        $arResult = array();
        
        global $db;
        $res = $db->selectDb(self::$tableNameUserActions, array('*'));
        while($arRes = $db->fetch($res)){
            $arResult[$arRes['code']]['code'] = $arRes['code'];
            $arResult[$arRes['code']]['text'] = $arRes['text'];
        }
        
        return $arResult;
    }
    
    /**
     * getListGroupsByUser() - получить список групп к каким относится пользователь
     * 
     * @param int $idUsers - id пользователя
     * @return array
     */
    public static function getListGroupsByUser($idUsers){
        $arResult = array();

        // определить id групп к каким относится пользователь
        global $db;
        $res = $db->selectDb(self::$tableNameUsersInGroupss, array('codeGroup'), array('='=>array('idUser', $idUsers )));
        while($arRes = $db->fetch($res)){
            $arResult[$arRes['codeGroup']] = $arRes['codeGroup'];
        }
        
        return $arResult;   
    }
    
    
    /**
     * addUserInGroup() - добавить пользователя в группуы
     * @param int $idUsers - id пользователя
     * @param string $codeGroup - код группы
     * @return boolean
     */
    public static function addUserInGroup($idUser, $codeGroup){
        $arResult = false;
        global $db;
        $res = $db->insertDb(
            self::$tableNameUsersInGroupss, 
            array(
                'codeGroup' => $codeGroup, 
                'idUser' => $idUser,
            )
        );
        if($res){
            $arResult = true;
        }
        return $arResult;
    }
    
    /**
     * deleteUserInAllGroups - удалить пользователя из всех групп 
     *  (где он состоит)
     * @param int $idUsers - id пользователя
     * @return boolean
     */
    public static function deleteUserInAllGroups($idUser){
        $arResult = false;
        global $db;
        $res = $db->deleteDb(self::$tableNameUsersInGroupss, array('=' => array('idUser', $idUser)) );
        if($res){
            $arResult = true;
        }
        return $arResult;
    }
    
}