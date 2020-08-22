<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/component/edit-users-propertys/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'edit-users-propertys',
    'text-info' => $langComponentInfo->GetMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'id-user'
    ),
    'all-property-text' => array(
        'id-user' => $langComponentInfo->GetMessage('property-id-user')
    )
);