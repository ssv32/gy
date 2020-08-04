<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

$componentInfo = array(
    'name' => 'containerdata_element_show',
    'text-info' => 'Вывод элемента контейнера данных',
    'v' => '0.1',
    'all-property' => array(
        'container-data-code' ,
        'element-code',
        'cacheTime'
    ),
    'all-property-text' => array(
        'container-data-code' => 'Код контейнера данных',
        'element-code' => 'Код элемента',
        'cacheTime' => 'Время кеширования'
    )
);