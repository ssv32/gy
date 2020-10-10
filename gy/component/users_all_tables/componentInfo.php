<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

global $APP;
$utlThisComponent = "/gy/component/users_all_tables/";
$langComponentInfo = new Lang($APP->urlProject.$utlThisComponent, 'componentInfo', $APP->options['lang']);

$componentInfo = array(
    'name' => 'users_all_tables',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
    'all-property' => array()
);