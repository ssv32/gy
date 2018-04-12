<?php
define("GY_GLOBAL_FLAG_CORE_INCLUDE", true); // флаг о том что ядро подключено

include_once("./gy/config/gy_config.php");

// TODO проверка конфига

if (defined("GY_LENGUAGE")) {
	include_once("./gy/lang/".GY_LENGUAGE.'.php');
}
////

include_once("./gy/gy_functions.php");

// print_r($arLong);

// include_once("./class");


?>