<?
include "../../gy/gy.php"; // подключить ядро // include core


global $user;

if ($user->isAdmin()){
	
	include "../../gy/admin/header-admin.php";?>
    
    <?
    $data = $_GET;
    
    if ( (!empty($data['info-box-id']) && is_numeric($data['info-box-id'])) && (!empty($data['el-id']) && is_numeric($data['el-id'])   ) ){

        $app->component(
            'infobox_element_property',
            '0',
            array(
                'info-box-id' => $data['info-box-id'],
                'el-id' => $data['el-id']
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