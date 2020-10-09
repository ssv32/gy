<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );
global $app;
global $user;

$langTextThisFile = new Lang($app->urlProject."/gy/admin", 'header-admin', $app->options['lang']);
?>

<html>
    <head>
        <title>gy -admin</title>
        <link href="../../gy/style/main.css" rel="stylesheet">
        <script src="../../gy/js/main.js"></script>
    </head>
    <body class="gy-body-admin">
        
        
        
        <h2 class="gy-admin-logo"><?=$langTextThisFile->getMessage('title')?></h2>
        <?php
        if (!empty($app->options['v-gy'])) {
        ?>
            <span class="version-gy-core">v <?=$app->options['v-gy']?></span>
            <br/>
        <?php
        }
        ?>
        <a href="/" class="gy-admin-button-min" ><?=$langTextThisFile->getMessage('site')?></a>
        <br/>
        <br/>
        <?php
        if (AccessUserGroup::accessThisUserByAction( 'show_admin_panel')) {

            // меню доступное для текущего пользователя
            $menu[ $langTextThisFile->getMessage('index-page') ] = '/gy/admin/index.php';

            if (AccessUserGroup::accessThisUserByAction( 'edit_users') || $user->isAdmin()) {
                $menu[ $langTextThisFile->getMessage('users') ] = '/gy/admin/users.php';
            }

            // надо добавить пункты меню заданные в подключенных модулях
            $module = Module::getInstance();
            foreach ($module->getButtonsMenuAllModules() as $nameModule => $arButton) {
                // условия показа пункта меню (задаётся модулем) или если админ
                if (
                    (
                        !empty($module->getFlagShowButtonsAdminPanelByModule[$nameModule])
                        && AccessUserGroup::accessThisUserByAction( $module->getFlagShowButtonsAdminPanelByModule[$nameModule]) 
                    )
                    || $user->isAdmin()
                ) {
                    foreach ($arButton as $buttonName => $buttonUrl) {
                        $menu[$buttonName] = $buttonUrl;
                    }
                }
            }

            $menu[ $langTextThisFile->getMessage('modules') ] = '/gy/admin/modules.php';
            
            if ($user->isAdmin()) {
                $menu[ $langTextThisFile->getMessage('options') ] = '/gy/admin/options.php';
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
