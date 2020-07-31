<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){
	
    include "../../gy/admin/header-admin.php";

    if (accessUserGroup::accessThisUserByAction( 'work_file_module')){
        $app->component(
            'work_page_site',
            '0',
            array() 
        );
    }

    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}