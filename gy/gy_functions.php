<?php
if (!defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && GY_GLOBAL_FLAG_CORE_INCLUDE !== true ) die('err_core');

function GetMessageCore($code_text) {
	$msg = "gy: err core function GetMessageCore";

	global $arLong;

	if (!empty($arLong)) {
		$msg = $arLong[$code_text];
	}
	return $msg;
} 

?>