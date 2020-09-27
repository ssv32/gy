<?php

if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

/**
 * cache - класс для работы с кешем
 * для даботы нужен раздел gy/cache/
 */
class CacheFiles extends Cache {
    private $urlCache = '/cache/';
    private $urlProject = '/';
    private $data = array();
    private $cacheName = 'noneme';
    private $cacheTime = '';
    private $endUrl = '.php';
    
    /**
     * 
     * @param type $urlProject - путь к проекту
     */
    public function __construct($urlProject) {
        $this->urlProject = $urlProject;
    }
    
    /**
     * cacheInit - инициализация кеша, надо проверить есть кеш по заданным параметрам
     * @param string $cacheName
     * @param int $cacheTime - время кеширования в секундах
     * @return boolean
     */
    public function cacheInit($cacheName, $cacheTime){
        $this->cacheName = $cacheName;
        $this->cacheTime = $cacheTime;
                
        if(file_exists($this->urlProject.$this->urlCache.$this->cacheName.$this->endUrl)){
            $cacheData = array();
            include $this->urlProject.$this->urlCache.$this->cacheName.$this->endUrl;
            
            if(!empty($cacheData) ){
                $cacheData = json_decode($cacheData, true);
                if( ((int) $cacheData['createTime'] + (int) $cacheData['cacheTime']) > time()) {
                    $this->data = $cacheData['data'];
                    unset($cacheData);
                }
            }    
        }
        
        return !empty($this->data); 
    }
    
    /**
     * getCacheData - получить данные из кеша
     * @return mixed - может быть массив или одиночное значение любого типа
     */
    public function getCacheData(){
        return $this->data;
    }
    
    /**
     * setCacheData - установить данные в кеш
     * @param mixed $data - может быть массив или одиночное значение
     * @return boolean true
     */
    public function setCacheData($data){
        $cacheData = array(
            'data' => $data,
            'createTime' => time(),
            'cacheTime' => $this->cacheTime
        );  
        if(file_exists($this->urlProject.$this->urlCache.$this->cacheName.$this->endUrl) ){
            file_put_contents($this->urlProject.$this->urlCache.$this->cacheName.$this->endUrl, '<?php $cacheData = '."'". json_encode($cacheData)."';" );  
        }
        return true;
    }
    
    /**
     * clearThisCache - удалит текущий кеш (кеш связанный с текущим объектом)
     */
    public function clearThisCache(){
        if(file_exists($this->urlProject.$this->urlCache.$this->cacheName.$this->endUrl)){
            unlink($this->urlProject.$this->urlCache.$this->cacheName.$this->endUrl);
        }
    }
    
}
