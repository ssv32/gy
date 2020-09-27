<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/modules/containerdata/component/containerdata_element_property/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'containerdata_element_property',
    'text-info' => $langComponentInfo->GetMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'container-data-id',
        'el-id'
    ),
    'all-property-text' => array(
        'container-data-id' => $langComponentInfo->GetMessage('property-container-data-id'),
        'el-id' => $langComponentInfo->GetMessage('property-el-id')
    )
);