<?php
include "../../gy/gy.php"; // подключить ядро // include core

include "../../gy/admin/header-admin.php";

$APP->component(
    'bread-crumbs',
    'admin',
    array( 
        'items' => array(
            '/gy/admin/' => 'Главная админки',
        )
    )
);

// пример вызова компонента // example run component
$APP->component(
    'admin',
    '0',
    array()
);

include "../../gy/admin/footer-admin.php";

