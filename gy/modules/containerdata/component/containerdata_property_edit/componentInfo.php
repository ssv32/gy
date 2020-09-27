<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/modules/containerdata/component/containerdata_property_edit/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'containerdata_property_edit',
    'text-info' => $langComponentInfo->GetMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'container-data-id'
    ),
    'all-property-text' => array(
        'container-data-id' => $langComponentInfo->GetMessage('property-container-data-id')
    )
);