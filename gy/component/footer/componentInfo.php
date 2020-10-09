<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/component/footer/";
$langComponentInfo = new Lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'footer',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
);