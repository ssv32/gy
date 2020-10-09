<?php

include "../../gy/gy.php"; // подключить ядро // include core

global $user;

if ($user->isAdmin()) {

    include "../../gy/admin/header-admin.php";

    // редактирование общих свойств пользователей
    $app->component(
        'edit-all-users-propertys',
        '0',
        array()
    );

    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}


