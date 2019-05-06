<?php
define("GY_GLOBAL_FLAG_CORE_INCLUDE", true); // флаг о том что ядро подключено // flag include core

include_once("config/gy_const.php"); // подключение констант // include const

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

// подключить класс работы с базой данный // include class work database
if (isset($db_config) 
    && isset($db_config['db_type']) 
    && isset($db_config['db_host']) 
    && isset($db_config['db_user']) 
    && isset($db_config['db_pass']) 
    && isset($db_config['db_name']) 
){
    if (file_exists(__DIR__ . '/class/class.'.$db_config['db_type'].'.php' )) {
        include __DIR__ . '/class/class.'.$db_config['db_type'].'.php';
		global $db;
        $db = new $db_config['db_type']; // mysql - for test work db mysql
        
        //echo '!!--!'.$db->test;
        
        //$db->connect($db_config['db_host'], $db_config['db_user'], $db_config['db_pass'], $db_config['db_name']);
        //$asd = $db->query($db->db, 'CREATE TABLE test (id int, name varchar(50) )');
//        var_$dbdump($asd);
//        $db->close($db->db);
    }
}

$crypto = new crypto();
if (!empty($global_config['sole'])){
	$crypto->setSole($global_config['sole']);
}

$user = new user;
$user->checkUserCookie();
	

$app = new app(__DIR__ );

?>