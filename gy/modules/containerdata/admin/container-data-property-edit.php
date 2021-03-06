<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'show_admin_panel')) {

    include "../../gy/admin/header-admin.php";

    if (Gy\Core\User\AccessUserGroup::accessThisUserByAction( 'edit_container_data') && is_numeric($_GET['container-data-id'])) {
        $id = $_GET['container-data-id'];

        $APP->component(
            'containerdata_property_edit',
            '0',
            array(
                'container-data-id' => $id
            )
        );

    } else {
        echo 'error not id container-data';
    }

    include "../../gy/admin/footer-admin.php";

} else {
    header( 'Location: /gy/admin/' );
}