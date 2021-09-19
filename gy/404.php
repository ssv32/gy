<?php include $_SERVER["DOCUMENT_ROOT"]."/gy/gy.php"; // подключить ядро // include core 

use Gy\Core\Lang;

global $APP;
global $USER;

$langTextThisFile = new Lang(
    $APP->urlProject."/gy/lang", 
    '404', 
    $APP->options['lang']
);

http_response_code(404);
?>

<div><?=$langTextThisFile->getMessage('error')?></div>
   
<?
die();