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
    'work_page_site'
);

// классы этого можуля
$classesThisModule = array(
    'files',
    'sitePages' 
);

// страници админки
$adminPageThisModule = array(
    'work-page-site',   
);

// кнопки для меню админки
$pagesFromAdminMenu = array(
    'Работа со страницами сайта' => '/gy/admin/get-admin-page.php?page=work-page-site'
);

// пользовательское действие, и если оно разрешено текущему пользователю то он увидит 
// в меню админки кнопки $pagesFromAdminMenu
$isShowButtonsMenuAdminPanetThisModule = 'work_file_module';

// имя текущего модуля
$nameThisModule = 'filemodule';

//версия текущего модуля
$versionThisModule = '0.1';