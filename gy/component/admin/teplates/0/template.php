<?/*<H2><?=$this->lang->GetMessage('hi');?></h2>*/?>
<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

global $app;

$app->component(
	'form_auth',
	'0',
	array( 
		'test' => 'asd',
		'idComponent' => 1,
	)
);

?>

