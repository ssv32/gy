<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

use Gy\Core\Lang;

global $APP;
$utlThisComponent = "/gy/modules/filemodule/component/work_page_site/";
$langComponentInfo = new Lang($APP->urlProject.$utlThisComponent, 'componentInfo', $APP->options['lang']);

$componentInfo = array(
    'name' => 'work_page_site',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
    'all-property' => array()
);