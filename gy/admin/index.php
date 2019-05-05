<?
include "../../gy/gy.php"; // подключить ядро // include core

if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

?>

<html>
	<head>
		<title>gy -admin</title>
		<link href="../../gy/style/main.css" rel="stylesheet">
	</head>	
	
	
	<?
	// пример вызова компонента // example run component
	$app->component(
		'admin',
		'0',
		array(),
		$app->url
	);

	?>
	
	
</html>	
