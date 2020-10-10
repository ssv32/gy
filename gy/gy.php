<?php
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
    include_once(__DIR__ . '/classes/module.php');

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
    function __autoload($calssname){ 
        global $URL_PROJECT;

        // проверю есть ли класс в подключённых модулях и подключу, иначе как всегда всё
        global $MODULE;
        $meyByClassModule = $MODULE->getUrlModuleClassByNameClass($calssname);
        if ($meyByClassModule !== false) {
            require_once( $meyByClassModule );
        } else {

            if (file_exists($URL_PROJECT."/customDir/classes/".$calssname.".php" )) { // сюда будут подключаться пользовательские классы
                require_once( $URL_PROJECT."/customDir/classes/".$calssname.".php" );
            } elseif (file_exists(__DIR__ . '/classes/'.$calssname.'.php' )) {
                require_once( "classes/$calssname.php" );
            } elseif (file_exists(__DIR__ . '/classes/abstract/'.$calssname.'.php' )) {
                // подключение abstract классов (что бы они хранились в отдельном разделе)
                require_once( "classes/abstract/$calssname.php" );
            } else {
                die('class '.$calssname.' not find' );
            }
        }
    }

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
        $DB = new $APP->options['db_config']['db_type']($APP->options['db_config']); // mysql - for test work db mysql
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
    $CACHE_CLASS_NAME = $APP->options['type_cache'];

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


    /*
    Примеры как можно прокидывать where условия в запросы 
     (возможно не рабочие но можно увидеть логику работы)

    issues/24 - теперь будет так
    global $DB;
    $res = $DB->selectDb(
        $DB->db, 
        'users', 
        array('*'), 
        array( 
            'AND' => array(
                array('=' => array('logIn', "'admin'") ), 
                array('=' => array('logIn', "'admin2'") ) 
            ),  
        )
    );

    */

    /*
    $res = $DB->selectDb(
        $DB->db, 
        'users', 
        array('*'), 
        array( 
            '=' => array('id', 1 ), 
        )
    );*/

}