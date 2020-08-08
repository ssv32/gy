<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/modules/containerdata/component/containerdata_element_show/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'containerdata_element_show',
    'text-info' => $langComponentInfo->GetMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'container-data-code' ,
        'element-code',
        'cacheTime'
    ),
    'all-property-text' => array(
        'container-data-code' => $langComponentInfo->GetMessage('property-container-data-code'),
        'element-code' => $langComponentInfo->GetMessage('property-element-code'),
        'cacheTime' => $langComponentInfo->GetMessage('property-cacheTime')
    )
);