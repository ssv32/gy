<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/component/form_auth/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'form_auth',
    'text-info' => $langComponentInfo->GetMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'idComponent'
    ),
    'all-property-text' => array(
        'idComponent' => $langComponentInfo->GetMessage('property-idComponent')
    )
);