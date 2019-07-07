<?php
	include "./gy/gy.php"; // подключить ядро // include core

	// if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );


	//echo GetMessageCore("err_include_core");
	//var_dump( GY_GLOBAL_FLAG_CORE_INCLUDE );
	//var_dump( GY_LENGUAGE );

	echo "ok";
	// $asd = `ls -l`;
	// echo $asd;
	
	// пример вызова компонента // example run component
	$app->component(
		'form_auth',
		'0',
		array( 
			'test' => 'asd',
			'idComponent' => 1,
		)
	);
        
        echo "ok2";
	$app->component(
		'form_auth',
		'0',
		array( 
			'test' => 'asd2',
			'idComponent' => 2,
		)
	);
?>


