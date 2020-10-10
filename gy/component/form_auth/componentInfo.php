<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

global $APP;
$utlThisComponent = "/gy/component/form_auth/";
$langComponentInfo = new Lang($APP->urlProject.$utlThisComponent, 'componentInfo', $APP->options['lang']);

$componentInfo = array(
    'name' => 'form_auth',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'idComponent'
    ),
    'all-property-text' => array(
        'idComponent' => $langComponentInfo->getMessage('property-idComponent')
    )
);