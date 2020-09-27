<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

/**
 * AccessUserGroup - будет всё что связано с правами доступов пользователей 
 * (и групп пользователей)
 */
class AccessUserGroup{
    
    private static $tableNameAccessGroup = 'access_group';
    private static $tableNameUserActions = 'action_user';
    private static $tableNameUsersInGroupss = 'users_in_groups';
    
    private static $cacheTimeGetData = 604800;
    
    /**
     * checkAccessUserGroupsByUserAction - определить можно ли пользователю с заданным набором его групп 
     *   и данными по всем группам выполнить указанное действие 
     * 
     * @param array $groupsThisUser - группы к каким относится пользователь
     * @param array $dataAllGroups - данные по всем группам
     * @param string $thisAction - проверяемое действие пользователя
     * @return boolean
     */
    private static function checkAccessUserGroupsByUserAction($groupsThisUser, $dataAllGroups, $thisAction){
        $arResult = false;

        // определить все действия разрешённые для данного пользователя
        $AllAccessActionsThisUser = array();
        foreach ($groupsThisUser as $nameGroup) {
            if($dataAllGroups[$nameGroup]){
                $AllAccessActionsThisUser = array_merge($AllAccessActionsThisUser, $dataAllGroups[$nameGroup]['code_action_user']);
            }
        }
        
        // найти заданное действие среди разрешённых для данного пользователя
        // либо проверить на админа (т.е. разрешены любые действия)
        if(in_array($thisAction , $AllAccessActionsThisUser) || in_array('action_all' , $AllAccessActionsThisUser) ){
            $arResult = true;
        }
        return $arResult;
    }
    
    /**
     * accessUser() - проверит разрешёно ли указанное действие заданному пользователю
     * 
     * @param int $userId - id пользователя
     * @param string $actionUser - код пользовательского действия
     * @return boolean
     */
    public static function accessUser($userId, $actionUser){

        // получить данные по пользователю 
        global $user;
        $dataUserFind = $user->getUserById($userId);
        
        // получить данные по всем группам
        $dataAllGroups = self::getAccessGroup();
        
        // определить пользователю с таким набором групп доступно ли указанное действие
        return self::checkAccessUserGroupsByUserAction($dataUserFind['groups'], $dataAllGroups, $actionUser);
    }
    
    /**
     * accessThisUserByAction - проверить разрешено ли текущему пользователю 
     *   указанное действие
     * 
     * @global type $user
     * @param string $action - код действия 
     * @return boolean
     */
    public static function accessThisUserByAction($action){
        global $user;
        $groupsThisUser = $user->getThisUserGroups();
        
        // получить данные по всем группам
        $dataAllGroups = self::getAccessGroup();
        
        // определить пользователю с таким набором групп доступно ли указанное действие
        $arResult = self::checkAccessUserGroupsByUserAction($groupsThisUser, $dataAllGroups, $action);

        return $arResult;
    }
    

    
    /**
     * getAccessGroup() - получить все группы пользователей какие есть
     *  + вернутся заданные в группах разрешения на пользовательские действия
     * @return array
     */
    public static function getAccessGroup(){
        $arResult = array();
        
        global $app;
        global $cacheClassName;
        $cache = new $cacheClassName($app->url);
        $initCache = $cache->cacheInit('getAccessGroup', self::$cacheTimeGetData);
        
        if ($initCache){
            $arResult = $cache->getCacheData();
        }else{
            
            global $db;
            $res = $db->selectDb(self::$tableNameAccessGroup, array('*'));
            while($arRes = $db->fetch($res)){
                if(!empty($arRes['code_action_user'])){
                    $arResult[$arRes['code']]['code_action_user'][$arRes['code_action_user']] = $arRes['code_action_user'];
                }
                $arResult[$arRes['code']]['name'] = $arRes['name'];
                $arResult[$arRes['code']]['code'] = $arRes['code'];
                $arResult[$arRes['code']]['text'] = $arRes['text'];
            }
            
            $cache->setCacheData($arResult);
        }
        
        return $arResult;
    }
        
    /**
     * clearCacheForFunctionGetAccessGroup -
     *  сбросить кеш на получение разрешений для групп и всех данных по группам
     * 
     * @global type $app
     * @global type $cacheClassName
     */
    public static function clearCacheForFunctionGetAccessGroup(){
        global $app;
        global $cacheClassName;
        $cache = new $cacheClassName($app->url);
        $cache->cacheInit('getAccessGroup', self::$cacheTimeGetData);
        $cache->clearThisCache();
    }
    
    /**
     * getUserAction() - получить все какие есть пользовательские действия
     * @return array
     */
    public static function getUserAction(){ 
        $arResult = array();
        
        global $app;
        global $cacheClassName;
        $cache = new $cacheClassName($app->url);
        $initCache = $cache->cacheInit('getUserAction', self::$cacheTimeGetData);
        
        if ($initCache){
            $arResult = $cache->getCacheData();
        }else{
            
            global $db;
            $res = $db->selectDb(self::$tableNameUserActions, array('*'));
            while($arRes = $db->fetch($res)){
                $arResult[$arRes['code']]['code'] = $arRes['code'];
                $arResult[$arRes['code']]['text'] = $arRes['text'];
            }
        
            $cache->setCacheData($arResult);
        }
            
        return $arResult;
    }
    
    /**
     * getListGroupsByUser() - получить список групп к каким относится пользователь
     * 
     * @param int $id_users - id пользователя
     * @return array
     */
    public static function getListGroupsByUser($id_users){
        $arResult = array();

        // определить id групп к каким относится пользователь
        global $db;
        $res = $db->selectDb(self::$tableNameUsersInGroupss, array('code_group'), array('='=>array('id_user', $id_users )));
        while($arRes = $db->fetch($res)){
            $arResult[$arRes['code_group']] = $arRes['code_group'];
        }
        
        return $arResult;   
    }
    
    
    /**
     * addUserInGroup() - добавить пользователя в группуы
     * @param int $id_users - id пользователя
     * @param string $code_group - код группы
     * @return boolean
     */
    public static function addUserInGroup($id_user, $code_group){
        $arResult = false;
        global $db;
        $res = $db->insertDb(
            self::$tableNameUsersInGroupss, 
            array(
                'code_group' => $code_group, 
                'id_user' => $id_user,
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
     * @param int $id_users - id пользователя
     * @return boolean
     */
    public static function deleteUserInAllGroups($id_user){
        $arResult = false;
        global $db;
        $res = $db->deleteDb(self::$tableNameUsersInGroupss, array('=' => array('id_user', $id_user)) );
        if($res){
            $arResult = true;
        }
        return $arResult;
    }
    
    /**
     * deleteAllActionsForGroup() 
     * - удалить все заданные, разрешённые действия пользователей для указанной группы
     * 
     * @global type $db
     * @param string $codeUserGroup
     * @return boolean
     */
    public static function deleteAllActionsForGroup($codeUserGroup){ 
        $arResult = false;
        global $db;
        $dataAllGroup = self::getAccessGroup();
                
        if( !empty($dataAllGroup[$codeUserGroup])){
            // тут будут данные по нужной группе
            $dataThisGroup = $dataAllGroup[$codeUserGroup];
            $dataThisGroup['code_action_user'] = '';
            
            // удаляем все данные по этой группе из БД
            $res = $db->deleteDb(self::$tableNameAccessGroup, array('=' => array('code', "'".$codeUserGroup."'")) );
                        
            if($res){
                // добавляем пустую группу
                $res2 = $db->insertDb(
                    self::$tableNameAccessGroup, 
                    $dataThisGroup
                );
                if($res2){
                    $arResult = true;
                }
            }
        }
           
    }
    
    /**
     * addOptionsGroup() 
     * - добавить для указанной группы пользователей разрешённое действие
     *  
     * @global type $db
     * @param string $codeUserGroup - код группы
     * @param string $codeAction - код пользовательского действия
     * @return boolean
     */
    public static function addOptionsGroup($codeUserGroup, $codeAction){
        $arResult = false;
        global $db;
        $dataAllGroup = self::getAccessGroup();
                
        if( !empty($dataAllGroup[$codeUserGroup])){
            $dataThisGroup = $dataAllGroup[$codeUserGroup];
          
            // если действий для пользователя нет обновить группу (добавить действия)
            if(empty($dataThisGroup['code_action_user'])){
                $dataThisGroup['code_action_user'] = $codeAction;
                // если мы попали сюда то всего одна запись в БД соответствует этой группе её и обновляем
                $res = $db->updateDb(
                    self::$tableNameAccessGroup, 
                    $dataThisGroup, 
                    array(
                        '=' => array(
                            'code', 
                            "'".$codeUserGroup."'"
                        ) 
                    )
                );
                if($res){
                    $arResult = true;
                }               
            } else{ // добавить копию группы с новым действием                
                $dataThisGroup['code_action_user'] = $codeAction;
                $res = $db->insertDb(
                    self::$tableNameAccessGroup, 
                    $dataThisGroup
                );
                if($res){
                    $arResult = true;
                }
            }
            
        }
                
        // сбросить кеш на получение разрешений для групп и всех данных по группам
        self::clearCacheForFunctionGetAccessGroup();
        
        return $arResult;
    }
    
    /**
     * addUserGroup
     *  - добавить новую пользовательскую группу 
     * 
     * @global type $db
     * @param array $arDataNewGroup - массив с данными по группе (name, code, text)
     * @param array $arActionUserThisGroup - массив с разрешёнными для этой группы действиями
     * @return boolean
     */
    public static function addUserGroup($arDataNewGroup, $arActionUserThisGroup){
        global $db;
        $arResult = true; 
        foreach ($arActionUserThisGroup as $value) {
            $res = $db->insertDb(
                self::$tableNameAccessGroup, 
                array(
                    'code' => $arDataNewGroup['code'], 
                    'name' => $arDataNewGroup['name'],
                    'text' => $arDataNewGroup['text'],
                    'code_action_user' => $value
                )
            );
            if($res){
                //$arResult = true;
            }else{
                $arResult = false;
            }
        }
        
        // сбросить кеш на получение разрешений для групп и всех данных по группам
        self::clearCacheForFunctionGetAccessGroup();
        
        return $arResult;
    }
    
    /**
     * deleteUserGroupByCode
     *  - удалить пользовательскую группу по коду группы
     * 
     * @global type $db
     * @param string $code_group - код удаляемой группы
     * @return boolean
     */
    public static function deleteUserGroupByCode($code_group){
        global $db;
        $arResult = false;
        // удалить все связи пользователей с этой группой
        
        $res = $db->deleteDb(
            self::$tableNameUsersInGroupss,
            array('=' => array('code_group' , "'".$code_group."'" ) )
        );
        if($res){
            $arResult = true;
        }
                
        // удалить группу по коду уруппы
        if($arResult){
            $arResult = false;
            $res = $db->deleteDb(
                self::$tableNameAccessGroup,
                array('=' => array('code' , "'".$code_group."'" ) )
            );
            if($res){
                $arResult = true;
            }
        }
        
        // сбросить кеш на получение разрешений для групп и всех данных по группам
        self::clearCacheForFunctionGetAccessGroup();
        
        return $arResult;   
    }
       
}