<?php
include "../../gy/gy.php"; // подключить ядро // include core

global $USER;

// проверим разрешено ли показывать админ панель текущему пользователю
if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'show_admin_panel')) {

    include "../../gy/admin/header-admin.php";

    // Проверим разрешено ли работать с пользователями текущему пользователю
    if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'edit_users')) {
        $APP->component(
            'add_user',
            '0',
            array(
                'back-url' => '/gy/admin/users.php'
            )
        );
    }
    
    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}

