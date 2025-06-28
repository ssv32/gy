<?php
include "../../gy/gy.php"; // подключить ядро // include core

global $USER;

$data = $_REQUEST;

if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'show_admin_panel')) {

    include "../../gy/admin/header-admin.php";
    
    if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'edit_users')) {

        if (isset($data['show-id']) && is_numeric($data['show-id'])) {
            // если есть параметр show-id то просто просмотреть все данные 
            //   по конкретному пользователю
            $APP->component(
                'show_user',
                '0',
                array(
                    'id' => $data['show-id'],
                    'show-bread-crumbs' => 1,
                    'bread-crumbs-items' => array(
                        '/gy/admin/' => 'Главная админки',
                        '/gy/admin/users.php' => 'Пользователи'
                    )
                )
            );

        } else { // просмотр всех пользователей
            
            $APP->component(
                'bread-crumbs',
                'admin',
                array( 
                    'items' => array(
                        '/gy/admin/' => 'Главная админки',
                        '/gy/admin/users.php' => 'Пользователи'
                    )
                )
            );

            // таблица с пользователями
            $APP->component(
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



