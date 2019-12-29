<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

/** 
 * описываю что есть в модуле 
 * - это на совести разработчика модуля
 * перечисляются имеющиеся классы и модули, а они лежат в стандартных папках 
 * (заранее обговорено какие есть разделы в модуле)
 */

// компоненты которые есть в модуле
$componentsThisModule = array(
    'containerdata',
    'containerdata_add',
    'containerdata_edit',
    'containerdata_element_list',
    'containerdata_element_property',
    'containerdata_element_show',
    'containerdata_property_edit'
);

// классы этого можуля
$classesThisModule = array(
    'containerData'
);

// страници админки
$adminPageThisModule = array(
    'container-data-add',
    'container-data-edit',
    'container-data-element-list',
    'container-data-element-property',
    'container-data-property-edit',
    'container-data',    
);

$pagesFromAdminMenu = array(
    'Контейнеры данных' => '/gy/admin/get-admin-page.php?page=container-data'
);

$isShowButtonsMenuAdminPanetThisModule = 'edit_container_data';

$nameThisModule = 'containerdata';