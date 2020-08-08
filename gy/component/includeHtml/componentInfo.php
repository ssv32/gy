<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/component/includeHtml/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'includeHtml',
    'text-info' => $langComponentInfo->GetMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'html',
        //'test'
    ),
    'all-property-text' => array(
        'html' => $langComponentInfo->GetMessage('property-html')
    )
);