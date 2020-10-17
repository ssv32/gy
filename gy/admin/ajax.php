<?php
include "../../gy/gy.php"; // подключить ядро // include core

$result = array(
    'stat' => 'err'
);

$data = $_REQUEST;

global $USER;

if ( Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'show_admin_panel') 
    && !empty($data['action'])
) {
    // действие удалить пользователя
    if (($data['action'] == 'user-del') && !empty($data['id-user'])) {

        $res = $USER->deleteUserById($data['id-user']);
        if ($res) {
            $result['stat'] = 'ok';
        }
    }
}

echo json_encode($result);

