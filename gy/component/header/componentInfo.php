<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/component/header/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'header',
    'text-info' => $langComponentInfo->GetMessage('text-info'),
    'v' => '0.1',
);