<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/modules/filemodule/component/work_page_site/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'work_page_site',
    'text-info' => $langComponentInfo->GetMessage('text-info'),
    'v' => '0.1',
    'all-property' => array()
);