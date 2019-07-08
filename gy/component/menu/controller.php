<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );


$arRes['thisUrl'] = $_SERVER['SCRIPT_NAME'];

// показать шаблон
$this->template->show($arRes, $this->arParam);
