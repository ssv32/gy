<?
include "../../gy/gy.php"; // подключить ядро // include core


global $user;

if ($user->isAdmin()){
	
	include "../../gy/admin/header-admin.php";?>
    
    <?
    if (is_numeric($_GET['info-box-id'])){
        $id = $_GET['info-box-id'];

        $app->component(
            'infobox_element_list',
            '0',
            array(
                'info-box-id' => $id
            )
        );

    }else{
        echo 'error not id info-box';
    }
	?>
    
	<?include "../../gy/admin/footer-admin.php";

} else {
	header( 'Location: /gy/admin/' );
}