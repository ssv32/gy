<body class="gy-body-admin">
	<H2><?=$this->lang->GetMessage('hi');?></h2>
	<?
	global $app;
	
	$app->component(
		'form_auth_0',
		'0',
		array( 
			'test' => 'asd',
			'idComponent' => 1,
		),
		$app->url
	);
	
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
