<?php
include "../../gy/gy.php"; // подключить ядро // include core

global $user;

$data = $_REQUEST;

if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){
	
    include "../../gy/admin/header-admin.php";

    if(accessUserGroup::accessThisUserByAction( 'edit_users')){
        
        if(isset($data['show-id']) && is_numeric($data['show-id']) ){ 
            // если есть параметр show-id то просто просмотреть все данные по конкретному пользователю  
            $app->component(
                'show_user',
                '0',
                array(
                    'id' => $data['show-id']
                )
            );
            
        }else{ // просмотр всех пользователей
            // таблица с пользователями
            $app->component(
                'users_all_tables',
                '0',
                array()
            );
        }
        
    }
    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}



