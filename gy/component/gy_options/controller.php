<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

$data = $_POST;

if(!empty($data['cacheClear'])){
    // нужно удалить все файлы из раздела /gy/cache/
    global $app;    
    $files = glob($app->url.'/cache/*'); 
    foreach($files as $file){
        if(is_file($file)){
            unlink($file); 
        }
    }
    $arRes['status'] = 'cacheClear-ok'; 
}

$arRes['button'] = array(
    'cacheClear'
);

// показать шаблон
$this->template->show($arRes, $this->arParam);
