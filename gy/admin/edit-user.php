<?
include "../../gy/gy.php"; // подключить ядро // include core

global $user;
$data = $_REQUEST;

if (accessUserGroup::accessThisUserByAction( 'show_admin_panel') 
    && !empty($data['edit-id']) 
    && is_numeric($data['edit-id']) 
    && ($data['edit-id'] != 1) 
){
	
	include "../../gy/admin/header-admin.php";
	
    if (accessUserGroup::accessThisUserByAction( 'edit_users')){
        $app->component(
            'edit_user',
            '0',
            array(
                'back-url' => '/gy/admin/users.php',
                'id-user' => $data['edit-id']
            )
        );
    }
        
	include "../../gy/admin/footer-admin.php";

} else {
	header( 'Location: /gy/admin/' );
}
	

?>