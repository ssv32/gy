<?php
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

/**
 * module - работа с модулями фреймворка
 */
class module{
    
    // массив подключённых модулей
    public $arrayIncludeModules = array(); 
    
    // соответствие компонентов подключенным модулям
    public $nameModuleByComponentName = array();
    
    // соответствие имени класса (находящегося в модуле) и имени модуля 
    public $nameClassModuleByNameModule = array();
    
    // url до папки gy в проекте
    private $urlGyCore = false;
    
    // обьект класса (всегда будет один)
    private static $module; 
    
    private function  __construct(){
        // заполнить пустотой
        $this->arrayIncludeModules = array();
        $this->nameModuleByComponentName = array();
        $this->nameClassModuleByNameModule = array();
    }
    
    /**
     * getInstance 
     *  - получение обьекта класса (всегда один обьект)
     * реализация singleton
     * 
     * @return jbject this class
     */
    public function getInstance(){
        if (static::$module === null){
            static::$module = new static();
        }
        return static::$module;
    }
    
    public function setUrlGyCore($urlGyCore){
        $this->urlGyCore = $urlGyCore;
    }
    
    /**
     * IncludeModule 
     *  - подключить указанный можуль
     *  (т.е. ядро узнает о классах, компонентах модуля и прочем)
     * 
     * @param string $nameModule - имя модуля
     * 
     * @return bool - вернёт true если модуль найден и подключен или false если нет
     */
    public function includeModule($nameModule){
        $result = false;
        if($this->urlGyCore !== false){
            $result = $this->IncludeModuleByUrl($this->urlGyCore.'/modules/'.$nameModule.'/');
        } // TODO возможно кудато вывести ошибку
        
        return $result;
    }
    
    
    public function includeModuleByUrl($urlModule){ // TODO можно добавить проверки на ошибки 
        $result = false;
        
        echo 'ok='.$urlModule;
        
        if(file_exists($urlModule.'init.php' )){
            include $urlModule.'init.php';
            
            // тут имя модуля
            if (!empty($nameThisModule)){
                $this->arrayIncludeModules[$nameThisModule] = $urlModule;
                //unset($nameThisModule);
            }
            
            // тут список компонентов модуля
            if (!empty($componentsThisModule)){ 

                foreach ($componentsThisModule as $value) {
                    $this->nameModuleByComponentName[$value] = $nameThisModule;
                }
                        
                unset($componentsThisModule);
            }
            
            // тут список классов модуля
            if (!empty($classesThisModule)){

                foreach ($classesThisModule as $value) {      
                    $this->nameClassModuleByNameModule[$value] = $nameThisModule;    
                }
                unset($classesThisModule);
            }
            
            
        }
        return $result;
    }
    
    // получить по имени компонента данные о компоненте из подключённых модулей
    public function getModulesComponent($nameComponent){
        $result = false;
        
        if(!empty($this->nameModuleByComponentName[$nameComponent])){
            $result = $this->arrayIncludeModules[ $this->nameModuleByComponentName[$nameComponent] ].'component/'.$nameComponent;                 
        }
        
        return $result;
    } 
    
    // по имени класса, если он есть в одном из подключённых модулей выдать урл на класс
    public function getUrlModuleClassByNameClass($nameClass){
        $result = false;
        if(!empty($this->nameClassModuleByNameModule[$nameClass])){
            $result = $this->arrayIncludeModules[ $this->nameClassModuleByNameModule[$nameClass] ].'classes/'.$nameClass.'.php';
        }
        return $result;
    }
    
}