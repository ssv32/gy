<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

$componentInfo = array(
    'name' => 'edit_user',
    'text-info' => 'Редактирование пользователя',
    'v' => '0.1',
    'all-property' => array(
        'back-url',
        'id-user'
    ),
    'all-property-text' => array(
        'back-url' => 'Ссылка на страницу откуда идёт редактирование',
        'id-user' => 'Id Пользователя которого надо редактировать'
    )
);