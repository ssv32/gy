<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

function getMessageCore($codeText) {
    $msg = "gy: err core function getMessageCore";

    global $AR_LONG;

    if (!empty($AR_LONG)) {
        $msg = $arLong[$codeText];
    }
    return $msg;
}
