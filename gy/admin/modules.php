<?php
include "../../gy/gy.php"; // подключить ядро // include core

global $USER;

if ($USER->isAdmin()) {

    include "../../gy/admin/header-admin.php";

    $APP->component(
        'bread-crumbs',
        'admin',
        array( 
            'items' => array(
                '/gy/admin/' => 'Главная админки',
                '/gy/admin/modules.php' => 'Модули'
            )
        )
    );
    
    // таблица с пользователями
    $APP->component(
        'show_include_modules',
        '0',
        array()
    );

    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}



