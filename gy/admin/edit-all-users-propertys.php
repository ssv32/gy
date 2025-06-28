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
                '/gy/admin/users.php' => 'Пользователи',
                '/gy/admin/edit-all-users-propertys.php' => 'Общие свойства пользователей',
            )
        )
    );
    
    // редактирование общих свойств пользователей
    $APP->component(
        'edit-all-users-propertys',
        '0',
        array()
    );

    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}


