<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

//include "../../gy/gy.php"; // подключить ядро // include core


//global $user;

if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){
	
	include "../../gy/admin/header-admin.php";?>
    
    <?
    if (accessUserGroup::accessThisUserByAction( 'edit_container_data') && is_numeric($_GET['container-data-id'])){
        $id = $_GET['container-data-id'];

        $app->component(
            'containerdata_property_edit',
            '0',
            array(
                'container-data-id' => $id
            )
        );

    }else{
        echo 'error not id container-data';
    }
	?>
    
	<?include "../../gy/admin/footer-admin.php";

} else {
	header( 'Location: /gy/admin/' );
}