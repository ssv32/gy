<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'show_admin_panel')) {

    include "../../gy/admin/header-admin.php";

    if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'edit_container_data')) {

        $data = $_GET;

        if ((!empty($data['container-data-id']) && is_numeric($data['container-data-id'])) && (!empty($data['el-id']) && is_numeric($data['el-id']))) {

            $APP->component(
                'containerdata_element_property',
                '0',
                array(
                    'container-data-id' => $data['container-data-id'],
                    'el-id' => $data['el-id']
                )
            );

        } else {
            echo 'error not id container-data';
        }
    }

    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}