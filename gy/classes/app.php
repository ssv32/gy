<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

final class app{

    public $url;
    public $options; // настройки проекта
    public $lang; // табличка с языковыми сообщениями
    //public $db; // db
    public $urlProject; // урл как $this-url только без /gy в конце
    
    private static $app;
    
    private function  __construct($url, $options){
        // подключить настройки
        $this->options = $options; 
       
        $this->url = $url;
        
        // записать ещё путь до проекта без последней директории т.е. без /gy
        $this->urlProject = substr($this->url, 0, (strlen($this->url) - 3) );
        
        // если есть языковой файл то надо подключить его
        $this->lang = new lang($url, 'app', $this->options['lang']);
    }

    /**
     * createApp - создать объект класса app, запишет его в статичное свойство и вернёт
     * @param string $url - расположение проекта
     * @return object class app
     */
    public static function createApp($url, $options){       
        if (  static::$app === null ){
            static::$app = new static($url, $options);
        }
        return static::$app;
    }
    
    /** 
     *  component отобразить компонент // show component
     * 	@param string $name - имя компонента и контроллера сразу 
     * 	@param string $template - имя шаблона 
     * 	@param array $arParam - параметры компонента (параметры кеша и прочие нюансы) // array component config
     *  @param strung $url - url где лежит проект
     * 	вернёт объект компонент
     * 
     * 	TODO возможно понадобится сделать подключение модели // если делать универсальные модели для компонентов
     * 		или возможность подключать много моделей разных
     * 		maybe includ many model in component
     */
    public function component($name, $template, $arParam  ){
        $component = new component($name, $template, $arParam, $this->urlProject, $this->options['lang']);
        return $component;
    }

}
