<?php /*<H2><?=$this->lang->getMessage('hi');?></h2>*/?>
<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

global $APP;

$APP->component(
    'form_auth',
    '0',
    array( 
        'test' => 'asd',
        'idComponent' => 1,
    )
);


