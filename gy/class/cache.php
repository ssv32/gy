<? 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

/** 
 * abstract class cache - описывает класс работы с кешем
 */
abstract class cache{

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
