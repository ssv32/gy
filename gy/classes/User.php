<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

class User{ 
	
    protected $authorized = false;
    protected $dataUser;
    protected $nameCookie = 'gy_user_auth';
    protected $admin = false; 
    public $tableName = 'users';

    public function __construct() {
        $this->checkUserCookie();
    }
    
    /**
     * getThisUserGroups - получить группы текущего пользователя
     * @return array
     */
    public function getThisUserGroups(){
        $arResult = array();
        if(!empty($this->dataUser['groups'])){
            $arResult = $this->dataUser['groups'];
        }
        return $arResult;
    }    
    
    /**
     * getDataThisUser - получить данные по текущему, авторизованному пользователю
     * @return array
     */
    public function getDataThisUser(){
        return $this->dataUser;
    }
	
    /**
     * isAdmin - проверить является ли текущий, авторизованный пользователем администратором
     * @return booleand
     */
    public function isAdmin(){
        return $this->admin;
    }
	
    /**
     * getAuthorized - узнать авторизован ли пользователь
     * @return booleand
     */
    public function getAuthorized(){
        return $this->authorized;
    }

    /**
     * getId - получить id текущего пользователя
     * @return int
     */
    public function getId(){
        return $this->dataUser['id'];
    }

    /**
     * authorized - авторизовать пользователя
     * @param type $log - логин
     * @param type $pass - пароль
     * @return booleand 
     */
    public function authorized($log, $pass ){
        $result = $this->chackUser($log, $pass);
        $this->authorized = $result;
        return $result;
    }
	
    /**
     * chackUser - проверить существует ли пользователь
     * @global type $db
     * @global type $crypto
     * @param type $log - логин
     * @param type $pass - пароль
     * @return booleand
     */
    protected function chackUser($log, $pass) { 
        $result = false;

        global $db;
        global $crypto;		
			
        $res = $db->selectDb(
            $this->tableName, 
            array('*'), 
            array(
                'AND' => array( 
                    array('=' => array('login', "'".$log."'" ) ),
                    array( '=' => array('pass',"'".md5($pass.$crypto->getSole())."'") )
                ),   
            )    
        );
        
        if ($arRes = $db->fetch($res)){				

            //$this->setUserCookie($arRes['id'] , $crypto->getRandString());
            $this->setUserCookie($arRes['id'] , $crypto->getStringForUserCookie($arRes['login'], $arRes['name'], $arRes['id']));
            $result = true;		
        }

        return $result;
		
    }
	
    /**
     * setUserCookie - установить пользовательскую куку
     * @global type $db
     * @param int $userId - id пользователя
     * @param string $StringCookie - строка, значение куки
     * @return boolean
     */
    protected function setUserCookie($userId, $StringCookie){
        setcookie($this->nameCookie, $StringCookie, 0, '/');
        global $db;
        
        $res = $db->updateDb(
            $this->tableName, 
            array('hash_auth' => $StringCookie), 
            array( '=' => array('id' , $userId ) )    
        );
        
        return true;
    }
	
    /**
     * deleteUserCookie - удалить пользовательскую куку
     * @global type $_COOKIE
     * @global type $db
     * @param int $userId - id пользователя
     * @return boolean
     */
    protected function deleteUserCookie($userId){
        global $_COOKIE;
        unset($_COOKIE[$this->nameCookie]);
        global $db;
        
        $res = $db->updateDb(
            $this->tableName, 
            array('hash_auth' => 'NULL'), 
            array( '=' => array('id' , $userId ) )    
        );
        
        return true;
    }
	
    /**
     * checkUserCookie - проверить пользовательскую куку
     * @global type $_COOKIE
     * @return boolean
     */
    public function checkUserCookie(){
        $result = false;

        global $_COOKIE;

        if(!empty($_COOKIE[$this->nameCookie]) ){

            $dataUser = $this->findUserByCookie($_COOKIE[$this->nameCookie]);

            if ($dataUser !== false){
                $this->dataUser = $dataUser;

                // получить группы к каким относится пользователь
                $this->dataUser['groups'] = AccessUserGroup::getListGroupsByUser($dataUser['id']);

                $this->authorized = true;
                if ( !empty($this->dataUser['groups']['admins']) ){
                    $this->admin = true;
                }
                $result = true;
            }
        }
        return $result;
    }
	
    /**
     * findUserByCookie - найти пользователя по значению куки
     * @global type $db
     * @param string $cookie
     * @return array - данные пользователя
     */
    protected function findUserByCookie($cookie){
        $result = false;

        global $db;

        $res = $db->selectDb(
            $this->tableName, 
            array('*'), 
            array( '=' => array('hash_auth', "'".$cookie."'") ) 
        );

        if ($arRes = $db->fetch($res)){
            $result = $arRes;		
        }

        return $result;
    }
	
    /**
     * userExit - сделать выход для пользователя 
     * @return boolean
     */
    public function userExit(){
        return $this->deleteUserCookie($this->dataUser['id']);
    }
	
    /**
     * getAllDataUsers - получить данные по пользователю 
     * @global type $db
     * @return array
     */
    public function getAllDataUsers(){
        $result = array();
        
        global $db;		        
        $res = $db->selectDb( 
            $this->tableName, 
            array('*')
        );
        $result = $db->fetchAll($res, false);
        
        // получить группы пользователей
        foreach ($result as $key => $value) {
            $result[$key]['groups'] = AccessUserGroup::getListGroupsByUser($value['id']);
        }
        
        return $result;
    }
	
    /**
     * getUserById - получить данные по пользователю по id
     * @global type $db
     * @param type $id
     * @return array
     */
    public function getUserById($id){
        $result = array();
        global $db;		        
        $res = $db->selectDb( 
            $this->tableName, 
            array('*'),
            array(
                '=' => array('id', $id)
            )
        );
        $result = $db->fetch($res, false);
        
        if(!empty($result)){
            // получить группы текущего пользователя
            $result['groups'] = AccessUserGroup::getListGroupsByUser($id);
        }
        
        return $result;
    }
    
    /**
     * addUsers - добавить пользователя
     * @global type $db
     * @global type $crypto
     * @param type $data
     * @return boolean
     */
    public function addUsers($data){
        $result = false;

        // id, login, name, pass, groups
        global $db;		
        $res = $db->insertDb($this->tableName, $data);
                
        if ($res){
            $result = true;
        }
			
        return $result;
    }
	
    /**
     * updateUserById - обновление данных пользователя
     * @global type $db
     * @param int $userId - id пользователя
     * @param array $arParams - данные пользователя
     * @return boolean
     */
    public function updateUserById($userId, $arParams){
        $result = false;

        unset($arParams['id']);
        
        global $db;		
        $res = $db->updateDb($this->tableName, $arParams, array('=' => array('id', $userId)));
        
        if ($res){
            $result = true;
        }
			
        return $result; 
    }
    
    /**
     * deleteUserById - удалить пользователя
     * @global type $db
     * @param int $id_user - id пользователя
     * @return string
     */
    public function deleteUserById($id_user){
        $result = false;

        if (is_numeric($id_user) && ($id_user != 1)){
            global $db;

            $res = $db->deleteDb($this->tableName, array('='=>array('id', $id_user)));

            if ($res){
                $result = true;		
            }
        }		
        return $result;
    }
	
}
