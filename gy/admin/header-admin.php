<?if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>

<html>
    <head>
        <title>gy -admin</title>
        <link href="../../gy/style/main.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="../../gy/js/main.js"></script>
    </head>	
    <body class="gy-body-admin">
        <h2 class="gy-admin-logo">Админка gy framework</h2>
        <?
        global $user;

        if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){

            // меню доступное для текущего пользователя
            $menu['Главная админки'] = '/gy/admin/index.php';

            if(accessUserGroup::accessThisUserByAction( 'edit_users') || $user->isAdmin()){ 
                $menu['Пользователи'] = '/gy/admin/users.php';
            }

            // надо добавить пункты меню заданные в подключенных модулях
            $module = module::getInstance();
            foreach ($module->getButtonsMenuAllModules() as $nameModule => $arButton) {
                // условия показа пункта меню (задаётся модулем) или если админ
                if(
                    (
                        !empty($module->getFlagShowButtonsAdminPanelByModule[$nameModule])
                        && accessUserGroup::accessThisUserByAction( $module->getFlagShowButtonsAdminPanelByModule[$nameModule]) 
                    )
                    || $user->isAdmin() ){
                    foreach ($arButton as $buttonName => $buttonUrl) {
                        $menu[$buttonName] = $buttonUrl;
                    }
                }
            }

            if($user->isAdmin()){
                $menu['Настройки'] = '/gy/admin/options.php';
            }

            // menu
            $app->component(
                'menu',
                '0',
                array(			
                    'buttons' => $menu
                )
            );
        }
