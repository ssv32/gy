<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

/**
 * Files - класс для работы с файлами
 */

class Files
{

    /**
     * createFile 
     *  - создать файл по урлу
     * 
     * @param string $url - путь к файлу
     * @return boolean
     */
    public static function createFile($url)
    {
        return file_put_contents($url, '');
    }

    /**
     * deleteFile
     *  - удалить файл по урлу
     * 
     * @param string $url - путь к файлу
     * @return boolean
     */
    public static function deleteFile($url)
    {
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
    public static function saveFile($url, $date)
    {
        return file_put_contents($url, $date);
    }

    /**
     * getContentFile
     *  - прочитать файл
     * 
     * @param string $url
     * @return boolean
     */
    public static function getContentFile($url)
    {
        return file_get_contents($url);
    }

}