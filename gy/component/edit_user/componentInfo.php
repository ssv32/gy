<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/component/edit_user/";
$langComponentInfo = new lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'edit_user',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'back-url',
        'id-user'
    ),
    'all-property-text' => array(
        'back-url' => $langComponentInfo->getMessage('property-back-url'),
        'id-user' => $langComponentInfo->getMessage('property-id-user')
    )
);