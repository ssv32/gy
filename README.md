<p align="center">
  <img src="gy/images/gy-icons.jpg" width="128" height="128"/>
</p>

# gy php framework
(ru):<br/>
### Установка  gy php framework:
- Установить пока можно php скриптом https://github.com/ssv32/install-gy-php-framework ;
- После установки необходимо задать настройки ядра gy framework, это можно сделать скриптом gy/install/consoleInstallOptions.php 
  (или в файле /gy/config/gy_config.php);
- Затем надо установить таблицы в базу данных (пока mysql) скриптом gy/install/installMysqlTable.php (предварительно нужно создать БД и задать доступы и её имя на шаге выше).

### Пример подключения gy php framework
`<?`<br/>
`include "./gy/gy.php"; // подключить ядро // include core`<br/>

### Пример проверки подключено ли ядро gy php framework
`<?if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>`

### Пример вызова компонента:

`<?`<br/>
`include "./gy/gy.php"; // подключить ядро `<br/>
<br/>
`// пример вызова компонента `<br/>
`$app->component(`<br/>
`⋅⋅⋅⋅'form_auth',`<br/>
`⋅⋅⋅⋅'0',`<br/>
`⋅⋅⋅⋅array( `<br/>
`⋅⋅⋅⋅⋅⋅⋅⋅'test' => 'asd',`<br/>
`⋅⋅⋅⋅⋅⋅⋅⋅'idComponent' => 1,`<br/>
`⋅⋅⋅⋅),`<br/>
`);`<br/>
<br/>


<p>Имеются файлы wiki по работе с framework, описанием реализованного (с точки зрения админки и пояснения для разработчиков)
https://github.com/ssv32/gy/wiki</p>
<br/><br/>
Также gy php framework имеет элементы CMS, это админка и прочее для управления контентом на страницах.
<br/><br/>
gy php framework протестирован и будет работать на php версиях (необходимо скомпилировать PHP с графической библиотекой GD):<br/>
5.6<br/>
7.0<br/>
7.1<br/>
<br/>

-----
(en):
### Install gy php framework:
- Can be installed with php script https://github.com/ssv32/install-gy-php-framework ;
- After installation, you need to set the kernel settings gy framework, this can be done with a script  gy/install/consoleInstallOptions.php 
  (or in file /gy/config/gy_config.php);
- Then you need to create tables in the database, this is done by a script (now only mysql) gy/install/installMysqlTable.php (first you need to create a database and set access and its name in the step above).

### Example сonnection gy php framework
`<?`<br/>
`include "./gy/gy.php"; // подключить ядро // include core`<br/>

### Example of checking if the kernel is connected gy php framework
`<?if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>`

### Example run component:
`<?`<br/>
`include "./gy/gy.php"; // include core`<br/>
<br/>
`// example run component`<br/>
`$app->component(`<br/>
`⋅⋅⋅⋅'form_auth',`<br/>
`⋅⋅⋅⋅'0',`<br/>
`⋅⋅⋅⋅array( `<br/>
`⋅⋅⋅⋅⋅⋅⋅⋅'test' => 'asd',`<br/>
`⋅⋅⋅⋅⋅⋅⋅⋅'idComponent' => 1,`<br/>
`⋅⋅⋅⋅),`<br/>
`);`<br/>
<br/>
There are wiki pages that show how to work with gy framework. (in terms of admin panel and explanation for developers)
https://github.com/ssv32/gy/wiki
<br/><br/>
Also, the gy php framework has CMS elements, this is the admin panel and more for managing content on pages.
<br/><br/>
gy php framework tested and will work on php versions (you need to compile PHP with the GD graphics library):<br/>
5.6<br/>
7.0<br/>
7.1<br/>
<br/>
