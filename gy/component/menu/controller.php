<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

$arRes['thisUrl'] = $_SERVER['SCRIPT_NAME'];

if (($arRes['thisUrl'] == '/gy/admin/get-admin-page.php') && !empty($_GET['page'])) {
    $arRes['thisUrl'] = '/gy/admin/get-admin-page.php?page='.htmlspecialchars($_GET['page']);
}

// показать шаблон
$this->template->show($arRes, $this->arParam);
