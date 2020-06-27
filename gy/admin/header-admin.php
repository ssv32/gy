<?if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );
global $app;
global $user;
?>

<html>
    <head>
        <title>gy -admin</title>
        <link href="../../gy/style/main.css" rel="stylesheet">
        <script src="../../gy/js/main.js"></script>
    </head>	
    <body class="gy-body-admin">
        <h2 class="gy-admin-logo">Админка gy framework</h2>
        <?if(!empty($app->options['v-gy'])){?>
            <span class="version-gy-core">v <?=$app->options['v-gy']?></span>
            <br/>
        <?}?>
        <a href="/" class="gy-admin-button-min" >Перейти на сайт</a>
        <br/>
        <br/>
        <?
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

            $menu['Модули'] = '/gy/admin/modules.php';
            
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
