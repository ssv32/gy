<?
include "../../gy/gy.php"; // подключить ядро // include core

global $user;

if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){
	
	include "../../gy/admin/header-admin.php";?>
    
    <?
    if (accessUserGroup::accessThisUserByAction( 'edit_container_data') && is_numeric($_GET['ID'])){
        $id = $_GET['ID'];

        $app->component(
            'containerdata_edit',
            '0',
            array(
                'ID' => $id
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