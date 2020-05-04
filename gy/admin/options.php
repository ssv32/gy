<?
include "../../gy/gy.php"; // подключить ядро // include core

global $user;

if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){
	
    include "../../gy/admin/header-admin.php";
        
    if(accessUserGroup::accessThisUserByAction('action_all')){
        $app->component(
            'gy_options',
            '0',
            array()
        );
    }
	
    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}