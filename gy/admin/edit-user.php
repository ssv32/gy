<?php

include "../../gy/gy.php"; // подключить ядро // include core

global $USER;
$data = $_REQUEST;

if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'show_admin_panel')
    && !empty($data['edit-id'])
    && is_numeric($data['edit-id'])
    && ($data['edit-id'] != 1)
) {

    include "../../gy/admin/header-admin.php";

    if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'edit_users')) {
        $APP->component(
            'edit_user',
            '0',
            array(
                'back-url' => '/gy/admin/users.php',
                'id-user' => $data['edit-id'],
                'show-bread-crumbs' => 1,
                'bread-crumbs-items' => array(
                    '/gy/admin/' => 'Главная админки',
                    '/gy/admin/users.php' => 'Пользователи'
                )
            )
        );
    }

    include "../../gy/admin/footer-admin.php";

} else {
	header( 'Location: /gy/admin/' );
}


