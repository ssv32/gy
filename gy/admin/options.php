<?php
include "../../gy/gy.php"; // подключить ядро // include core

global $USER;

if (AccessUserGroup::accessThisUserByAction( 'show_admin_panel')) {

    include "../../gy/admin/header-admin.php";

    if (AccessUserGroup::accessThisUserByAction('action_all')) {
        $APP->component(
            'gy_options',
            '0',
            array()
        );
    }

    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}