<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/component/form_auth_test/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'form_auth_test',
    'text-info' => $langComponentInfo->GetMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'test',
        'idComponent',
    ),
    'all-property-text' => array(
        'test' => $langComponentInfo->GetMessage('property-test'),
        'idComponent' => $langComponentInfo->GetMessage('property-idComponent')
    )
);