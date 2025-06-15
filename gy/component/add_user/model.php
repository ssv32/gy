<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

$this->userProperty = array(
    'login',
    'name',
    'pass',
    'groups'
);

$this->allUsersGroups = null;
$this->stat = null;
$this->statText = null;
$this->backUrl = null;


