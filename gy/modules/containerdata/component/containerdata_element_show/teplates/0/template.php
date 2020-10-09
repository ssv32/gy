<?php if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

if (!empty($arRes['ITEMS'])) {
    foreach ($arRes['ITEMS'] as $value) { 
        echo ((!empty($value['value']))? $value['value'] : '');
    } 
}