<?

include "../../gy/gy.php"; // подключить ядро // include core

if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

global $user;

if ($user->isAdmin()){
	
	include "../../gy/admin/header-admin.php";
	?>
	<h3>Add user</h3>
	<?
	
	$app->component(
		'add_user',
		'0',
		array(
			'back-url' => '/gy/admin/users.php'
		),
		$app->url
	);
	
	include "../../gy/admin/footer-admin.php";

} else {
	header( 'Location: /gy/admin/' );
}
	

?>