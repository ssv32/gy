<?
include "../../gy/gy.php"; // подключить ядро // include core

if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

?>

<?include "../../gy/admin/header-admin.php";?>
	
	<?
	// пример вызова компонента // example run component
	$app->component(
		'admin',
		'0',
		array(),
		$app->url
	);

	?>
	
<?include "../../gy/admin/footer-admin.php";?>

