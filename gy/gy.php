<?php
define("GY_GLOBAL_FLAG_CORE_INCLUDE", true); // флаг о том что ядро подключено // flag include core

include_once("config/gy_config.php"); // подключение настроек ядра // include options

// авто подключение классов
function __autoload($calssname){ 
    if (file_exists(__DIR__ . '/class/'.$calssname.'.php' )){
        require_once( "class/$calssname.php" );          
    } else{
        die('class '.$calssname.' not find' );
    }
}

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
//while ($arRes = $db->GetResult_fetch_assoc($res)){
//    print_r($arRes);
//
//}