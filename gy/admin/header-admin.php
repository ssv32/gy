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

        if ($user->isAdmin()){
            // menu
            $app->component(
                'menu',
                '0',
                array(			
                    'buttons' => array(
                        'Главная админки' => '/gy/admin/index.php',
                        'Пользователи' => '/gy/admin/users.php',
                        'info-box' => '/gy/admin/info-box.php',
                        'Настройки' => '/gy/admin/options.php'
                    )
                )
            );
        }
        ?>