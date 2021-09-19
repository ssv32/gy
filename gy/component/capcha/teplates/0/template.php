<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );?>

<div>
    <img src="?capcha_get_image=1<?=((!empty($_REQUEST['secretKeyAdminPanel']))? '&secretKeyAdminPanel='.$_REQUEST['secretKeyAdminPanel'] : '');?>" />
    <input name="capcha" type="text" value="" />
</div>