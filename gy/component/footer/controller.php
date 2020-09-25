<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

// показать шаблон
$this->template->show($arRes, $this->arParam);
