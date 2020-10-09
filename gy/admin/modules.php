<?php
include "../../gy/gy.php"; // подключить ядро // include core

global $user;

if ($user->isAdmin()){

    include "../../gy/admin/header-admin.php";

    // таблица с пользователями
    $app->component(
        'show_include_modules',
        '0',
        array()
    );

    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}



