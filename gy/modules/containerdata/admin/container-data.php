<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){
	
    include "../../gy/admin/header-admin.php";
    
    if(accessUserGroup::accessThisUserByAction( 'edit_container_data')){

        $app->component(
            'containerdata',
            '0',
            array()
        );
        
    }
    
    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}