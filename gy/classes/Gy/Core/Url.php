<?php

namespace Gy\Core;

if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

/** 
 * Url - класс с url текущего запроса
 * class work url
 */
class Url
{
    /**
     * getThisUrlNotGetProperty 
     *  - получить тукущий url без параметров get
     * 
     * @return null/string 
     */
    static public function getThisUrlNotGetProperty(){
        $result = null;
        global $_SERVER;
        $url = explode('?', $_SERVER['REQUEST_URI']);
        if (!empty($url[0])){
            $result = $url[0];
        }
        return $result;
    }
    

}