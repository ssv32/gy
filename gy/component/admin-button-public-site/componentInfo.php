<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/component/admin-button-public-site/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'admin-button-public-site',
    'text-info' => $langComponentInfo->GetMessage('text-info'),
    'v' => '0.1',
    'all-property' => array()
);