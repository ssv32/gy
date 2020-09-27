<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/component/hed-meta-tag-seo/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'hed-meta-tag-seo',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
);