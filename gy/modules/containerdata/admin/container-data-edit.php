<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'show_admin_panel')) {

    include "../../gy/admin/header-admin.php";

    if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'edit_container_data') && is_numeric($_GET['ID'])) {
        $id = $_GET['ID'];

        $APP->component(
            'containerdata_edit',
            '0',
            array(
                'ID' => $id,
                'show-bread-crumbs' => 1,
                'bread-crumbs-items' => array(
                    '/gy/admin/' => 'Главная админки',
                    '/gy/admin/get-admin-page.php?page=container-data' => 'Контейнеры данных'
                )
            )
        );

    } else {
        echo 'error not id container-data';
    }

    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}