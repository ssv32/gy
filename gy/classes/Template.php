<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

class Template{
    public $templateUrl; // ссылка на шаблон
    // public $name; // имя шаблона
    public $lang;
    private $urlFileStyle; // url на файл со стилями, для этого шаблона
    private $urlFileJs; // url для файла с js, для этого шаблона
    
    public function __construct($url, $lang){
        $this->templateUrl = $url.'/template.php';

        // проверить существует ли файл стилей для компонента
        if(file_exists($url.'/style.css')){
            $this->urlFileStyle = $url.'/style.css';
        }

        // если есть файл js 
        if(file_exists($url.'/script.js')){
            $this->urlFileJs = $url.'/script.js';
        }

        $this->lang = new Lang($url, 'template', $lang);
    }

    /* show - нарисовать/показать шаблон 
    *	arr - массив с данными для шаблона
    */
    /*public function show($arr){
        $arRes = $arr;
        include $this->template_url;
        // TODO как то по красивее сделать
    }*/

    /** 
     * show - нарисовать/показать шаблон 
     * @param $arRes - массив с данными для шаблона // array for template
     * 
     * @return void - ничего не вернёт, подключится файл шаблона // include template
     */
    public function show($arRes, $arParam){

        // если есть стили то добавить стили
        if(!empty($this->urlFileStyle)){
            echo '<style>';
            include $this->urlFileStyle;
            echo '</style>';
        }

        // файл шаблона
        include $this->templateUrl;

        // если есть js то добавить его
        if(!empty($this->urlFileJs)){
            echo '<script>';
            include $this->urlFileJs;
            echo '</script>';
        }
    }
}

