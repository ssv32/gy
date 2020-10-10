<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

global $APP;
$utlThisComponent = "/gy/component/hed-meta-tag-seo/";
$langComponentInfo = new Lang($APP->urlProject.$utlThisComponent, 'componentInfo', $APP->options['lang']);

$componentInfo = array(
    'name' => 'hed-meta-tag-seo',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
);