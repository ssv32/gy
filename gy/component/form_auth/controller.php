<?php 
// контроллер компонента form_auth (форма авторизации)

// $model - теоретически должно быть тут доступно
if (!empty($_REQUEST['auth'])){
	
	$arRes["auth_ok"] = 'ok';
	$arRes["auth_user"] = $_REQUEST['auth'];
	
} else {

	$arRes["auth"] = "auth";


}
?>