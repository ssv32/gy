<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

/** 
 * описываю что есть в модуле 
 * - это на совести разработчика модуля
 * перечисляются имеющиеся классы и модули, а они лежат в стандартных папках 
 * (заранее обговорено какие есть разделы в модуле)
 */

// языковой файл
global $lang;
include 'lang_init.php';

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
    'ContainerData'
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

// кнопки для меню админки
$pagesFromAdminMenu = array(
    $mess[$lang]['name-button'] => '/gy/admin/get-admin-page.php?page=container-data'
);

// пользовательское действие, и если оно разрешено текущему пользователю то он увидит 
// в меню админки кнопки $pagesFromAdminMenu
$isShowButtonsMenuAdminPanetThisModule = 'edit_container_data';

// имя текущего модуля
$nameThisModule = 'containerdata';

// версия текущего модуля
$versionThisModule = '0.1';