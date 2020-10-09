<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$arRes = array();

// контроллер компонента admin 

// показать шаблон
$this->template->show($arRes, $this->arParam);
