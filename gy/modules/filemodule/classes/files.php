<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

/**
 * files - класс для работы с файлами
 */

class files{
        
     
    /**
     * createFile 
     *  - создать файл по урлу
     * 
     * @param string $url - путь к файлу
     * @return boolean
     */
    static function createFile($url){
        return file_put_contents($url, '');
    }
    
    /**
     * deleteFile
     *  - удалить файл по урлу
     * 
     * @param string $url - путь к файлу
     * @return boolean
     */
    static function deleteFile($url){
        return unlink($url);
    }
    
    /**
     * saveFile
     *  - сохранить текст в файл по урлу
     * 
     * @param string $url - путь к файлу
     * @param string $date - данные для записи в файл
     * @return boolean
     */
    static function saveFile($url, $date){
        return file_put_contents($url, $date);
    }
    
    /**
     * getContentFile
     *  - прочитать файл
     * 
     * @param string $url
     * @return boolean
     */
    static function getContentFile($url){
        return file_get_contents($url); 
    }
    
    
} 