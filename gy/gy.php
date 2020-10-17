<?php

use Gy\Core\App;
use Gy\Core\Security;
use Gy\Core\Crypto;
use Gy\Core\Module;
use Gy\Core\User\User;

// если ядро не подключено подключаем всё а если уже подключено то не надо
if ( !defined("GY_CORE") && (GY_CORE !== true) ) {

    ob_start();
    define("GY_CORE", true); // флаг о том что ядро подключено // flag include core

    include_once("config/gy_config.php"); // подключение настроек ядра // include options

    if (in_array($gyConfig['lang'], array('rus', 'eng'))) {
        global $LANG;
        $LANG = $gyConfig['lang'];
    }

    // подключаем класс модуля 
    // (нужен для подключения модулей до определения авто подключения классов)
    include_once(__DIR__ . '/classes/Gy/Core/Module.php');

    // подключить модули
    global $MODULE;
    $MODULE = Module::getInstance();
    $MODULE->setUrlGyCore(__DIR__);
    //$MODULE->includeModule('containerdata');
    $MODULE->includeAllModules();

    // путь к проекту
    global $URL_PROJECT;
    $URL_PROJECT = substr(__DIR__, 0, (strlen(__DIR__) - 3) );
    
    // авто подключение классов
    function autoload($className)
    {
        global $URL_PROJECT;
        
        // проверю есть ли класс в подключённых модулях и подключу (в модулях psr0 нет)
        global $MODULE;
        $meyByClassModule = $MODULE->getUrlModuleClassByNameClass($className);
        
        if ($meyByClassModule !== false) {
            require_once( $meyByClassModule );
        } else {
            $className = ltrim($className, '\\');
            $fileName  = '';
            $namespace = '';
            if ($lastNsPos = strrpos($className, '\\')) {
                $namespace = substr($className, 0, $lastNsPos);
                $className = substr($className, $lastNsPos + 1);
                $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }
            $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
                
            // TODO можно сделать поддержку psr0 в customDir/classes или переименовать в вендор
            if (file_exists($URL_PROJECT.DIRECTORY_SEPARATOR.'customDir'.DIRECTORY_SEPARATOR.'classes/'.DIRECTORY_SEPARATOR.$fileName)){
                require $URL_PROJECT.DIRECTORY_SEPARATOR.'customDir'.DIRECTORY_SEPARATOR.'classes/'.DIRECTORY_SEPARATOR.$fileName;
            }else{ // в разделе gy/classes будет поддержка psr0
                require 'classes'.DIRECTORY_SEPARATOR.$fileName;
            }
        }
    }
    spl_autoload_register('autoload');
        
    // обезопасить получаемый конфиг
    $gyConfig = Security::filterInputData($gyConfig);

    global $APP;
    // добавлю версию ядра gy
    $gyConfig['v-gy'] = '0.2-alpha';
    $APP = App::createApp($URL_PROJECT, $gyConfig);
    unset($gyConfig);

    // подключить класс работы с базой данный // include class work database
    if (isset($APP->options['db_config'])
        && isset($APP->options['db_config']['db_type'])
        && isset($APP->options['db_config']['db_host'])
        && isset($APP->options['db_config']['db_user'])
        && isset($APP->options['db_config']['db_pass'])
        && isset($APP->options['db_config']['db_name'])
    ) {
        global $DB;
        
        if ($APP->options['db_config']['db_type'] == 'MySql') {
            $DB = new Gy\Core\Db\MySql($APP->options['db_config']); 
        } elseif ($APP->options['db_config']['db_type'] == 'PgSql') {
            $DB = new Gy\Core\Db\PgSql($APP->options['db_config']); 
        } elseif ($APP->options['db_config']['db_type'] == 'PhpFileSqlClientForGy') {
            $DB = new Gy\Core\Db\PhpFileSqlClientForGy($APP->options['db_config']); 
        }
 
    }   
    
    global $CRYPTO;
    $CRYPTO = new Crypto();
    if (!empty($APP->options['sole'])) {
        $CRYPTO->setSole($APP->options['sole']);
    }

    global $USER;
    $USER = new User();

    // объявить имя класса для кеша // TODO пока так но сделать надо получше (заменить на фабрику или ещё какой патерн)
    if (!isset($APP->options['type_cache'])) {
        $APP->options['type_cache'] = 'cacheFiles';
    }
    global $CACHE_CLASS_NAME;
    $CACHE_CLASS_NAME = 'Gy\\Core\\Cache\\'.$APP->options['type_cache'];   

    session_start();

    // нужно обезопасить все входные данные
    // на этой странице не проверять, т.к. там могут сохраняться данные html (своства контейнера данных)
    // TODO - может как то это пофиксить
    if( ($APP->getUrlTisPageNotGetProperty() != '/gy/admin/get-admin-page.php')
        && ($_REQUEST['page'] != 'container-data-element-property' )
    ) {
        $_REQUEST = Security::filterInputData($_REQUEST);
        $_GET = Security::filterInputData($_GET);
        $_POST = Security::filterInputData($_POST);
    }

}