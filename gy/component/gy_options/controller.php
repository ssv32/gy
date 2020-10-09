<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;

$data = $_POST;

if (!empty($data['cacheClear'])) {
    // нужно удалить все файлы из раздела /gy/cache/
       
    $files = glob($app->url.'/cache/*'); 
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file); 
        }
    }
    $arRes['status'] = 'cacheClear-ok'; 
}

$arRes['button'] = array(
    'cacheClear'
);

// возможные варианты языка
$arRes['langs'] = array(
    'rus',
    'eng'
);

$arRes['this-lang'] = $app->options['lang'];

if (!empty($data['save']) && in_array($data['lang'], $arRes['langs'])) {

    // задать настройки сразу ядра
    global $argv;
    $argv = array();
    $argv[] = 1;
    $argv[] = 'set-option';
    $argv[] = 'lang';
    $argv[] = $data['lang'];
    
    ob_start();
    include $_SERVER["DOCUMENT_ROOT"].'/gy/install/consoleInstallOptions.php';
    $consoleLog = ob_get_contents();
    ob_end_clean();

    if ($consoleLog != "run set-option\nfinish set-option\n") {
        $arRes['status'] = 'save-ok'; 
    } else {
        $arRes['status'] = 'save-err'; 
        $arRes['status-text'] = $consoleLog;
    }
    
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
