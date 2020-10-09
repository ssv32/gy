<?php
// если ядро не подключено подключаем всё а если уже подключено то не надо
if ( !defined("GY_CORE") && (GY_CORE !== true) ) {

    ob_start();
    define("GY_CORE", true); // флаг о том что ядро подключено // flag include core

    include_once("config/gy_config.php"); // подключение настроек ядра // include options

    if (in_array($gy_config['lang'], array('rus', 'eng'))) {
        global $lang;
        $lang = $gy_config['lang'];
    }

    // подключаем класс модуля 
    // (нужен для подключения модулей до определения авто подключения классов)
    include_once(__DIR__ . '/classes/module.php');

    // подключить модули
    //global $module;
    $module = Module::getInstance();
    $module->setUrlGyCore(__DIR__);
    //$module->includeModule('containerdata');
    $module->includeAllModules();

    // путь к проекту
    global $urlProject;
    $urlProject = substr(__DIR__, 0, (strlen(__DIR__) - 3) );

    // авто подключение классов
    function __autoload($calssname){ 
        global $urlProject;

        // проверю есть ли класс в подключённых модулях и подключу, иначе как всегда всё
        global $module;
        $meyByClassModule = $module->getUrlModuleClassByNameClass($calssname);
        if ($meyByClassModule !== false) {
            require_once( $meyByClassModule );
        } else {

            if (file_exists($urlProject."/customDir/classes/".$calssname.".php" )) { // сюда будут подключаться пользовательские классы
                require_once( $urlProject."/customDir/classes/".$calssname.".php" );
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
    $gy_config = Security::filterInputData($gy_config);

    global $app;
    // добавлю версию ядра gy
    $gy_config['v-gy'] = '0.2-alpha';
    $app = App::createApp($urlProject, $gy_config);
    unset($gy_config);

    // подключить класс работы с базой данный // include class work database
    if (isset($app->options['db_config'])
        && isset($app->options['db_config']['db_type'])
        && isset($app->options['db_config']['db_host'])
        && isset($app->options['db_config']['db_user'])
        && isset($app->options['db_config']['db_pass'])
        && isset($app->options['db_config']['db_name'])
    ) {
        global $db;
        $db = new $app->options['db_config']['db_type']($app->options['db_config']); // mysql - for test work db mysql
    }

    global $crypto;
    $crypto = new Crypto();
    if (!empty($app->options['sole'])) {
        $crypto->setSole($app->options['sole']);
    }

    global $user;
    $user = new User();

    // объявить имя класса для кеша // TODO пока так но сделать надо получше (заменить на фабрику или ещё какой патерн)
    if (!isset($app->options['type_cache'])) {
        $app->options['type_cache'] = 'cacheFiles';
    }
    global $cacheClassName;
    $cacheClassName = $app->options['type_cache'];

    session_start();

    // нужно обезопасить все входные данные
    // на этой странице не проверять, т.к. там могут сохраняться данные html (своства контейнера данных)
    // TODO - может как то это пофиксить
    if( ($app->getUrlTisPageNotGetProperty() != '/gy/admin/get-admin-page.php')
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
    global $db;
    $res = $db->selectDb(
        $db->db, 
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
    $res = $db->selectDb(
        $db->db, 
        'users', 
        array('*'), 
        array( 
            '=' => array('id', 1 ), 
        )
    );*/

}