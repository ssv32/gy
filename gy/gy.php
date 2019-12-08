<?php
define("GY_GLOBAL_FLAG_CORE_INCLUDE", true); // флаг о том что ядро подключено // flag include core

include_once("config/gy_config.php"); // подключение настроек ядра // include options

// подключаем класс модуля 
// (нужен для подключения модулей до определения автоподключения классов)
include_once(__DIR__ . '/classes/module.php');

// подключить модули
global $module;
$module = module::getInstance();
$module->setUrlGyCore(__DIR__);
$module->includeModule('containerdata');

// авто подключение классов
function __autoload($calssname){ 
    
    // проверю есть ли класс в подключённых модулях и подключу, иначе как всегда всё
    global $module;
    $meyByClassModule = $module->getUrlModuleClassByNameClass($calssname);
    if($meyByClassModule !== false){
        require_once( $meyByClassModule );
    }else{
        if (file_exists(__DIR__ . '/classes/'.$calssname.'.php' )){
            require_once( "classes/$calssname.php" );          
        } elseif(file_exists(__DIR__ . '/classes/abstract/'.$calssname.'.php' )){
            // подключение abstract классов (что бы они хранились в отдельном разделе)
            require_once( "classes/abstract/$calssname.php" );   
        }else{
            die('class '.$calssname.' not find' );
        }
    }
}

global $app;
$app = app::createApp(__DIR__, $gy_config);
unset($gy_config);

// подключить класс работы с базой данный // include class work database
if (isset($app->options['db_config']) 
    && isset($app->options['db_config']['db_type']) 
    && isset($app->options['db_config']['db_host']) 
    && isset($app->options['db_config']['db_user']) 
    && isset($app->options['db_config']['db_pass']) 
    && isset($app->options['db_config']['db_name']) 
){
    global $db;
    $db = new $app->options['db_config']['db_type']($app->options['db_config']); // mysql - for test work db mysql
}

global $crypto;	
$crypto = new crypto();
if (!empty($app->options['sole'])){
	$crypto->setSole($app->options['sole']);
}

$user = new user;
$user->checkUserCookie();

// обьявить имя класса для кеша // TODO пока так но сделать надо получше (заменить на фабрику или ещё какой патерн)
if (!isset($app->options['type_cache'])) {  
    $app->options['type_cache'] = 'cacheFiles';
} 
global $cacheClassName;
$cacheClassName = $app->options['type_cache'];


//echo "nameModuleByComponentName <pre>";
//print_r($module->nameModuleByComponentName);
//echo "</pre>>";
//
//echo "nameClassModuleByNameModule <pre>";
//print_r($module->nameClassModuleByNameModule);
//echo "</pre>>";
//
//echo "arrayIncludeModules <pre>";
//print_r($module->arrayIncludeModules);
//echo "</pre>>";
        
session_start();


/*
global $db;
$res = $db->selectDb(
    $db->db, 
    'users', 
    array('*'), 
    array( 'AND' => array(
        '=' => array('logIn', "'admin'"), 
        //'>' => array('id', 0),
        'AND' =>  array('=' => array('logIn', "'admin2'") //,
            //'AND' =>  array('=' => array('logIn', "'admin2'") )
            ),
        
        //'<' => array('asd', 2),
        ) 
    )
);*/

/*
$res = $db->selectDb(
    $db->db, 
    'users', 
    array('*'), 
    array( 
        '=' => array('id', 1,), 
        
    )
);*/

//print_r($res);
//
//while ($arRes = $db->fetch($res)){
//    print_r($arRes);
//
//}