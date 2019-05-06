<?php 

$arRes['thisUrl'] = $_SERVER['SCRIPT_NAME'];

// показать шаблон
$this->template->show($arRes, $this->arParam);
?>