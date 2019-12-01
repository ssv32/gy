<?
include "../../gy/gy.php"; // подключить ядро // include core


global $user;

if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){
	
	include "../../gy/admin/header-admin.php";?>
    
    <?if(accessUserGroup::accessThisUserByAction( 'edit_container_data')){?>

        <h1>containerData</h1>

        <?
        $app->component(
            'containerdata',
            '0',
            array()
        );
        ?>
    
    <?}?>
    
	<?include "../../gy/admin/footer-admin.php";

} else {
	header( 'Location: /gy/admin/' );
}