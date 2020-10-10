<?php
include "../../gy/gy.php"; // подключить ядро // include core

include "../../gy/admin/header-admin.php";

// пример вызова компонента // example run component
$APP->component(
    'admin',
    '0',
    array()
);

include "../../gy/admin/footer-admin.php";

