<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'show_admin_panel')) {

    include "../../gy/admin/header-admin.php";

    $APP->component(
        'bread-crumbs',
        'admin',
        array( 
            'items' => array(
                '/gy/admin/' => 'Главная админки',
                '/gy/admin/get-admin-page.php?page=work-page-site' => 'Работа со страницами сайта'
            )
        )
    );
    
    if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'work_file_module')) {
        $APP->component(
            'work_page_site',
            '0',
            array() 
        );
    }

    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}