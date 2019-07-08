# gy php framework

### Установка  gy php framework
Установить пока можно php скриптом ниже
https://github.com/ssv32/install-gy-php-framework
После установки необходимо задать настройки ядра gy framework, это можно сделать скриптом gy/install/consoleInstallOptions.php
Затем надо установить и создать базу данных (пока mysql) скриптом gy/install/installMysqlTable.php (! он ещё не доделан)


### Пример подключения gy php framework
`<?`<br/>
`include "./gy/gy.php"; // подключить ядро // include core`<br/>

### Пример проверки подключено ли ядро gy php framework
`<?if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>`


### Пример вызова компонента:
`<?`<br/>
`include "./gy/gy.php"; // подключить ядро // include core`<br/>
<br/>
`// пример вызова компонента // example run component`<br/>
`$app->component(`<br/>
`⋅⋅⋅⋅'form_auth',`<br/>
`⋅⋅⋅⋅'0',`<br/>
`⋅⋅⋅⋅array( `<br/>
`⋅⋅⋅⋅⋅⋅⋅⋅'test' => 'asd',`<br/>
`⋅⋅⋅⋅⋅⋅⋅⋅'idComponent' => 1,`<br/>
`⋅⋅⋅⋅),`<br/>
`⋅⋅⋅⋅$app->url`<br/>
`);`<br/>
<br/>
<br/>
<br/>
