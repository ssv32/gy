<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

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
        
        // записать ещё путь c /gy
        $this->url = $url.'/gy';
        
        // путь до проекта
        $this->urlProject = $url;
        
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
        if($name != 'includeHtml'){
            // обезопасим входные параметры
            $arParam = security::filterInputData($arParam);
        }
        
        $component = new component($name, $template, $arParam, $this->urlProject, $this->options['lang']);
        return $component;
    }

    /**
     * getAllUrlTisPage()
     *  - вернёт полный путь к текущей страницы (вместе с get параметрами)
     * 
     * @return string
     */
    public function getAllUrlTisPage(){
        return $_SERVER['REQUEST_URI'];
    }
    
    /**
     * getUrlTisPageNotGetProperty()
     *  - вернёт полный путь к текущей страницы (без get параметров)
     * 
     * @return string
     */
    public function getUrlTisPageNotGetProperty(){
        return $_SERVER['SCRIPT_NAME'];
    }
    
    
}
