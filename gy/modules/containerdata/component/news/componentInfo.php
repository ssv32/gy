<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

use Gy\Core\Lang;

global $APP;
$utlThisComponent = "/gy/modules/containerdata/component/news/";
$langComponentInfo = new Lang($APP->urlProject.$utlThisComponent, 'componentInfo', $APP->options['lang']);

$componentInfo = array(
    'name' => 'news',
    'text-info' => $langComponentInfo->getMessage('text-info'),
    'v' => '0.1',
    'all-property' => array(
        'container-data-id',
        'container-data-code',
        'cacheTime', 
        'count-news-in-1-page',
        'show-pagination', 
        'show-property-news', 
        'show-in-url-code',
        'this-url-dir'
    ),
    'all-property-text' => array(
        'container-data-id' => $langComponentInfo->getMessage('property-container-data-id'),
        'container-data-code' => $langComponentInfo->getMessage('property-container-data-code'),
        'cacheTime' => $langComponentInfo->getMessage('cacheTime'),
        'count-news-in-1-page' => $langComponentInfo->getMessage('count-news-in-1-page'),
        'show-pagination' => $langComponentInfo->getMessage('show-pagination'),
        'show-property-news' => $langComponentInfo->getMessage('show-property-news'),
        'show-in-url-code' => $langComponentInfo->getMessage('show-in-url-code'),
        'this-url-dir' => $langComponentInfo->getMessage('show-in-url-code'),
    )
);