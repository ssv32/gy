<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

global $APP;
$utlThisComponent = "/gy/component/includeHtml/";
$langComponentInfo = new Lang($APP->urlProject.$utlThisComponent, 'componentInfo', $APP->options['lang']);

$componentInfo = array(
    'name' => 'includeHtml',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'html',
        //'test'
    ),
    'all-property-text' => array(
        'html' => $langComponentInfo->getMessage('property-html')
    )
);