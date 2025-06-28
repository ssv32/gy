<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$arRes['this-url'] = Gy\Core\Url::getThisUrlNotGetProperty();

$this->template->show($arRes, $this->arParam);
