<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

global $app;
$utlThisComponent = "/gy/component/edit-users-propertys/";
$langComponentInfo = new Lang($app->urlProject.$utlThisComponent, 'componentInfo', $app->options['lang']);

$componentInfo = array(
    'name' => 'edit-users-propertys',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'id-user'
    ),
    'all-property-text' => array(
        'id-user' => $langComponentInfo->getMessage('property-id-user')
    )
);