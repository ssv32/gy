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

global $user;
if ($user->isAdmin()){
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
}
?>

