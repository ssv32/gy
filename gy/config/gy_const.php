<?php // тут будут константы // а может и нет)
if (!defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && GY_GLOBAL_FLAG_CORE_INCLUDE !== true ) die('err_core');

//define("GY_LENGUAGE", "ru");
//define("GY_TYPE_DB", "mysql");

$db_config = array(
    // db config
    'db_type' => 'mysql',
    'db_host' => 'localhost',
    'db_user' => '*********', // заменить на настоящего пользователя // replace by true user 
    'db_pass' => '*********', // заменить на настоящий пароль // replace by true password
    'db_name' => 'gy_db',
    ////
);

?>