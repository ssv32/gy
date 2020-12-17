<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

use Gy\Core\Capcha;

global $APP;

$arRes = array();

$data = $_REQUEST;

if (!empty($data['capcha_get_image']) && ($data['capcha_get_image'] == 1)) {

    $capcha = new Capcha( $APP->url.Capcha::$defaultUrlFonts );   
    
    // нарисовать капчу
    $capcha->getImageCapcha();
     
} else {
    // показать шаблон
    $this->template->show($arRes, $this->arParam);
}

