<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

// подключить даныне по всем подключенным модулям
$module = module::getInstance();
$arRes['info-modules'] = $module->getInfoAllIncludeModules();

// показать шаблон
$this->template->show($arRes, $this->arParam);
