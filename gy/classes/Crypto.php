<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

class Crypto{
	
    private $sole; 
	
    /**
     * setSole - установить соль (некая строка)
     * @param string $sole
     * @return boolean true
     */
    public function setSole($sole){
        $this->sole = $sole;
        return true;
    }
	
    /**
     * getSole - получить значение соли
     * @return string
     */
    public function getSole(){
        return $this->sole;
    }
	
    /**
     * getRandString - даст произвольную строку
     * @return string
     */
    public function getRandString(){
        return md5(microtime().$this->sole);
    }
	
    /**
     * getStringForUserCookie - даст строку для пользовательской куки
     *  (склеит соль имя id пользователя и сделает md5)
     * @param string $login
     * @param string $name
     * @param int $id
     * @return string (md5)
     */
    public function getStringForUserCookie($login, $name, $id){
        return md5(microtime().$login.$this->sole.$name.$id);
    }

}


