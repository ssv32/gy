<?php 
class app{

    public $url;
    public $options; // настройки проекта
    public $lang; // табличка с языковыми сообщениями
    public $db; // db

    public function  __construct($url){
        // подключить настройки

        if (file_exists($url.'/config/gy_config.php' )) {	
                include $url.'/config/gy_config.php';
                $this->options = $g_config; 
                unset($g_config);
        }
        ////
        $this->url = $url;
        // если есть языковой файл то надо подключить его
        $this->lang = new lang($url, 'app', $this->options['lang']);
    }

    /* component отобразить компонент // show component
    * 	$name - имя компонента и контроллера сразу 
    * 	$template - имя шаблона 
    * 	$arr - параметры компонента (параметры кеша и прочие нюансы) // array component config
    * 
    * 	вернёт объект компонент
    * 
    * 	TODO возможно понадобится сделать подключение модели // если делать универсальные модели для компонентов
    * 		или возможность подключать много моделей разных
    * 		maybe includ many model in component
    */
    public function component($name, $template, $arParam, $url ){
        $component = new component($name, $template, $arParam, $url);
        return $component;
    }

}
?>