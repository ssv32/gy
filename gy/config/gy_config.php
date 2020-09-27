<?php
if (!defined("GY_CORE") && GY_CORE !== true ) die('err_core');

$gy_config = array(
    'lang' => 'rus', // eng
    'sole' => 'pass1021asz#_@)A',
    'db_config' => array(
        
        //--- example connect mysql---
        'db_type' => 'mysql', 
        'db_host' => 'localhost',
        'db_user' => 'root', // заменить на настоящего пользователя // replace by true user 
        'db_pass' => '', 
        'db_name' => 'gy_db',
        'db_port' => '31006',
        //---
        
        //--- example connect PhpFileSql---
        //'db_host' => 'localhost',
        //'db_url' => 'C:/OSPanel/domains/demo-gy.lc/customDir/db/',
        //'db_type' => 'PhpFileSqlClientForGy', 
        //'db_user' => 'root', // заменить на настоящего пользователя // replace by true user 
        //'db_pass' => '12345678', // заменить на настоящий пароль // replace by true password
        //'db_name' => 'gy_db',
        //---
        
        //--- example connect PostgreSQL---
        //'db_type' => 'pgsql', 
        //'db_host' => 'localhost',
        //'db_user' => 'postgres', // заменить на настоящего пользователя // replace by true user 
        //'db_pass' => '', 
        //'db_name' => 'gy_db',
        //'db_port' => '5432',
        //---
        
    ),
    'type_cache' => 'cacheFiles'
);