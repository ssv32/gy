<?php 

global $user;
$arRes['allUsers'] = $user->getAllDataUsers();

// показать шаблон
$this->template->show($arRes, $this->arParam);
?>