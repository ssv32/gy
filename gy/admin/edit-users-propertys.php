<?php
include "../../gy/gy.php"; // подключить ядро // include core

global $user;
$data = $_REQUEST;

if (AccessUserGroup::accessThisUserByAction( 'show_admin_panel')
    && !empty($data['edit-id'])
    && is_numeric($data['edit-id'])
    && ($data['edit-id'] != 1) 
) {

    include "../../gy/admin/header-admin.php";

    if (AccessUserGroup::accessThisUserByAction( 'edit_users')) {

        // редактирование общих свойств пользователей
        $app->component(
            'edit-users-propertys',
            '0',
            array(
                'id-user' => $data['edit-id']
            )
        );
    }
    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}


