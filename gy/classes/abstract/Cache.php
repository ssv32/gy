<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

/** 
 * abstract class Cache - описывает класс работы с кешем
 */
abstract class Cache{

    /**
     * cacheInit - инициализация кеша
     * @param string $cacheName
     * @param int $cacheTime - время кеширования в секундах
     * @return boolean
     */
    abstract public function cacheInit($cacheName, $cacheTime);
    
    /**
     * getCacheData() - получить данные из кеша
     * @return mixed - может быть массив или одиночное значение любого типа
     */
    abstract public function getCacheData();
    
    /**
     * setCacheData - записать данные в в кеш
     * @param mixed $data - может быть массив или одиночное значение
     * @return boolean true
     */
    abstract public function setCacheData($data);
}
