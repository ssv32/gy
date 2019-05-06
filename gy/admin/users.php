<?
include "../../gy/gy.php"; // подключить ядро // include core

if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

global $user;

if ($user->isAdmin()){
	
	include "../../gy/admin/header-admin.php";
	?>
	<body>
		<?
		// menu
		$app->component(
			'menu',
			'0',
			array(			
				'buttons' => array(
					'Пользователи' => '/gy/admin/users.php'
				)
			),
			$app->url
		);
		?>
	</body>	
	<?	
	include "../../gy/admin/footer-admin.php";

} else {
	header( 'Location: /gy/admin/' );
}

?>

