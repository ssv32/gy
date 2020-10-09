<?php
include "../../gy/gy.php"; // подключить ядро // include core

global $user;

// проверим разрешено ли показывать админ панель текущему пользователю
if (AccessUserGroup::accessThisUserByAction( 'show_admin_panel')){

    include "../../gy/admin/header-admin.php";

    // Проверим разрешено ли работать с пользователями текущему пользователю
    if (AccessUserGroup::accessThisUserByAction( 'edit_users')){
        $app->component(
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

