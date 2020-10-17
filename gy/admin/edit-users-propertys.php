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

        // редактирование общих свойств пользователей
        $APP->component(
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


