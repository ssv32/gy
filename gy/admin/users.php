<?
include "../../gy/gy.php"; // подключить ядро // include core


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
		)
	);
	?>
	<br/>
	<?
	// таблица с пользователями
	$app->component(
		'users_all_tables',
		'0',
		array()
	);
	?>
	
    <br/>
    <br/>
	<a class="gy-admin-button" href="add-user.php">add user</a>
	<br/>
	<br/>
    
	<?
	include "../../gy/admin/footer-admin.php";

} else {
	header( 'Location: /gy/admin/' );
}

?>

