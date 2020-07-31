<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

function GetMessageCore($code_text) {
    $msg = "gy: err core function GetMessageCore";

    global $arLong;

    if (!empty($arLong)) {
        $msg = $arLong[$code_text];
    }
    return $msg;
} 
