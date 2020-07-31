<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

class model{
    public $url; // ссылка на шаблон

    public function __construct($url){
            $this->url = $url;
    }

    /**
     * includeModel - подключить файл с моделью компонента
     */
    public function includeModel(){		
        require_once $this->url; // !!!
    }
}

