<?
if (!defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && GY_GLOBAL_FLAG_CORE_INCLUDE !== true ) die('err_core');

$gy_config = array(
    'lang' => 'rus', // eng
    'sole' => 'pass1021asz#_@)A',
    'db_config' => array(
        
        //--- example connect mysql---
        'db_type' => 'mysql', 
        'db_host' => 'localhost',
        'db_user' => 'root', // заменить на настоящего пользователя // replace by true user 
        'db_pass' => '', 
        //---
        
        //--- example connect mysql---
        //'db_url' => 'C:/OSPanel/domains/demo-gy.lc/customDir/db/',
        //'db_type' => 'PhpFileSqlClientForGy', 
        //'db_user' => 'root', // заменить на настоящего пользователя // replace by true user 
        //'db_pass' => '12345678', // заменить на настоящий пароль // replace by true password
        //---
        
        'db_name' => 'gy_db',
    ),
    'type_cache' => 'cacheFiles'
);