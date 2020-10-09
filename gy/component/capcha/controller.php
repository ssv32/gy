<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;

$arRes = array();

$capcha = new Capcha( $app->url.capcha::$defaultUrlFonts );

$data = $_REQUEST;

if (!empty($_REQUEST['capcha_get_image']) && ($_REQUEST['capcha_get_image'] == 1)) {
    // нарисовать капчу
    $capcha->getImageCapcha();
} else {
    // показать шаблон
    $this->template->show($arRes, $this->arParam);
}