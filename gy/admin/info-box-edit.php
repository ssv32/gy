<?
include "../../gy/gy.php"; // подключить ядро // include core


global $user;

if ($user->isAdmin()){
	
	include "../../gy/admin/header-admin.php";?>
    
    <?
    if (is_numeric($_GET['ID'])){
        $id = $_GET['ID'];

        $app->component(
            'infobox_edit',
            '0',
            array(
                'ID' => $id
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