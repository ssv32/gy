<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/modules/containerdata/component/containerdata_element_show/";
$langComponentInfo = new Lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'containerdata_element_show',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'container-data-code' ,
        'element-code',
        'cacheTime'
    ),
    'all-property-text' => array(
        'container-data-code' => $langComponentInfo->getMessage('property-container-data-code'),
        'element-code' => $langComponentInfo->getMessage('property-element-code'),
        'cacheTime' => $langComponentInfo->getMessage('property-cacheTime')
    )
);