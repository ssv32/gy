<?
include "../../gy/gy.php"; // подключить ядро // include core

if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

global $user;

if ($user->isAdmin()){
	
	include "../../gy/admin/header-admin.php";
	
	// menu
	$app->component(
		'menu',
		'0',
		array(			
			'buttons' => array(
				'Главная админки' => '/gy/admin/index.php',
				'Пользователи' => '/gy/admin/users.php'
			)
		),
		$app->url
	);
	?>
	<br/>
	<?
	// таблица с пользователями
	$app->component(
		'users_all_tables',
		'0',
		array(),
		$app->url
	);
	
	
	include "../../gy/admin/footer-admin.php";

} else {
	header( 'Location: /gy/admin/' );
}

?>

