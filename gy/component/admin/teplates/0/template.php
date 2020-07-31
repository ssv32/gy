<?/*<H2><?=$this->lang->GetMessage('hi');?></h2>*/?>
<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

global $app;

$app->component(
    'form_auth',
    '0',
    array( 
        'test' => 'asd',
        'idComponent' => 1,
    )
);


