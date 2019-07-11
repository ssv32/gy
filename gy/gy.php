<?php
define("GY_GLOBAL_FLAG_CORE_INCLUDE", true); // флаг о том что ядро подключено // flag include core

//include_once("config/gy_const.php"); // подключение констант // include const

include_once("config/gy_config.php"); // подключение настроек ядра // include options

// подключение необходимых классов // include all class core
include __DIR__ . '/app.php';
//include __DIR__ . '/class/component.php';
//include __DIR__ . '/class/model.php';
//include __DIR__ . '/class/template.php';
//include __DIR__ . '/class/controller.php';
//include __DIR__ . '/class/lang.php';
include __DIR__ . '/class/class.db.php';
////

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
    if (file_exists(__DIR__ . '/class/class.'.$app->options['db_config']['db_type'].'.php' )) {
        include __DIR__ . '/class/class.'.$app->options['db_config']['db_type'].'.php';
		global $db;
        $db = new $app->options['db_config']['db_type']($app->options['db_config']); // mysql - for test work db mysql
    }
}

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