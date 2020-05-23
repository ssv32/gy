<?
include "../../gy/gy.php"; // подключить ядро // include core

global $user;

if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){
	
    include "../../gy/admin/header-admin.php";

    if(accessUserGroup::accessThisUserByAction( 'edit_users')){
        // таблица с пользователями
        $app->component(
            'users_all_tables',
            '0',
            array()
        );
        ?>
        <?
    }
    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}



