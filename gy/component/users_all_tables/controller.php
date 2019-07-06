<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

global $user;
$arRes['allUsers'] = $user->getAllDataUsers();

// показать шаблон
$this->template->show($arRes, $this->arParam);
?>