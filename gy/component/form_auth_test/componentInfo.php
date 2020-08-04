<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

$componentInfo = array(
    'name' => 'form_auth_test',
    'text-info' => 'Форма авторизации тестовая, авторизации в ядре gy не происходит (просто демонстрация работы нескольких компонентов одновременно)',
    'v' => '0.1',
    'all-property' => array(
        'test',
        'idComponent',
    ),
    'all-property-text' => array(
        'test' => 'Поле для теста',
        'idComponent' => 'Уникальное число (придумать надо самому) в рамках страницы сайта где вызывается компонент (сделано если два одинаковых компонента будут на одной странице сайта)'
    )
);