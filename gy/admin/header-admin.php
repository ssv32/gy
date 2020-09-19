<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );
global $app;
global $user;

$langTextThisFile = new lang($app->urlProject."/gy/admin", 'header-admin', $app->options['lang']);
?>

<html>
    <head>
        <title>gy -admin</title>
        <link href="../../gy/style/main.css" rel="stylesheet">
        <script src="../../gy/js/main.js"></script>
    </head>	
    <body class="gy-body-admin">
        
        
        
        <h2 class="gy-admin-logo"><?=$langTextThisFile->GetMessage('title')?></h2>
        <?if(!empty($app->options['v-gy'])){?>
            <span class="version-gy-core">v <?=$app->options['v-gy']?></span>
            <br/>
        <?}?>
        <a href="/" class="gy-admin-button-min" ><?=$langTextThisFile->GetMessage('site')?></a>
        <br/>
        <br/>
        <?
        if (accessUserGroup::accessThisUserByAction( 'show_admin_panel')){

            // меню доступное для текущего пользователя
            $menu[ $langTextThisFile->GetMessage('index-page') ] = '/gy/admin/index.php';

            if(accessUserGroup::accessThisUserByAction( 'edit_users') || $user->isAdmin()){ 
                $menu[ $langTextThisFile->GetMessage('users') ] = '/gy/admin/users.php';
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

            $menu[ $langTextThisFile->GetMessage('modules') ] = '/gy/admin/modules.php';
            
            if($user->isAdmin()){
                $menu[ $langTextThisFile->GetMessage('options') ] = '/gy/admin/options.php';
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
