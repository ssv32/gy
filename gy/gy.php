<?php
define("GY_GLOBAL_FLAG_CORE_INCLUDE", true); // флаг о том что ядро подключено // flag include core

include_once("./gy/config/gy_const.php"); // подключение констант // include const

// подключение необходимых классов // include all class core
include __DIR__ . '/app.php';
include __DIR__ . '/class/component.php';
include __DIR__ . '/class/model.php';
include __DIR__ . '/class/template.php';
include __DIR__ . '/class/controller.php';
include __DIR__ . '/class/lang.php';
////

$app = new app(__DIR__ );

?>