<?
include "../../gy/gy.php"; // подключить ядро // include core

global $user;
$data = $_REQUEST;

if ($user->isAdmin() && !empty($data['edit-id']) && is_numeric($data['edit-id']) && ($data['edit-id'] != 1) ){
	
	include "../../gy/admin/header-admin.php";
	
	$app->component(
		'edit_user',
		'0',
		array(
			'back-url' => '/gy/admin/users.php',
            'id-user' => $data['edit-id']
		)
	);
	
	include "../../gy/admin/footer-admin.php";

} else {
	header( 'Location: /gy/admin/' );
}
	

?>