<p align="center">
  <img src="gy/images/gy-icons.jpg" width="128" height="128"/>
</p>

# gy php framework
(ru):<br/>

Gy – это php framework/CMS.

### Системные требования:
- php, необходимо скомпилировать с графической библиотекой GD, тестировалась на версиях версии 5.6, 7.0, 7.1 .
- Поддерживаются базы данных (протестированы):
  -	mySQL 5.6 ;
  -	MariaDB-10.3 ;
  -	PhpFileSql v0.2-alpha (https://github.com/ssv32/PhpFileSql) ;
  -	PostgreSQL 9.2 .
  
Вес файлов: 350 Кб (с демо данными).<br/>
Вес базы данных: 208 Кб (с демо данными).

### Установка  gy php framework:
- Установить можно php скриптом от сюда - https://github.com/ssv32/install-gy-php-framework 
  (имеется консольный и графический скрипт), или склонировать этот репозиторий;
- После установки необходимо задать настройки ядра gy framework, это можно сделать скриптом `gy/install/consoleInstallOptions.php` 
  (или отредактировав файл `/gy/config/gy_config.php`);
- Затем надо установить таблицы в базу данных скриптом gy/install/installDataBaseTable.php (предварительно нужно создать БД и задать доступы и её имя на шаге выше).

### После установки
- В админ панель можно попасть из браузера так `<домен вашего проекта>/gy/admin/` (admin admin).<br/>
- Есть демо сайт, его можно установить консольным скриптом `gy/install/installDemoSite1.php` (Нужно послать первым параметром `start`, пример `php -f gy/install/installDemoSite1.php start`).<br/>
- Демо сайт нужен для небольшой демонстрации, он включает в себя директорию `customDir`, с примером кастомизации шаблона компонента, раздел `classes` (для пользовательских классов или переопределения классов gy), и файл основной страницы `index.php`.

### Документация
<p>Имеются файлы wiki по работе с framework, описанием реализованного (с точки зрения админки и пояснения для разработчиков)
https://github.com/ssv32/gy/wiki</p>
<br/><br/>

### Пример подключения gy php framework
`<?`<br/>
`include "./gy/gy.php"; // подключить ядро // include core`<br/>

### Пример проверки подключено ли ядро gy php framework
`<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>`

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


-----
(en):

Gy – php framework/CMS.

### System requirements:
- php, you need to compile with the GD graphics library, tested on version versions 5.6, 7.0, 7.1 .
- Databases supported (tested):
  -	mySQL 5.6 ;
  -	MariaDB-10.3 ;
  -	PhpFileSql v0.2-alpha (https://github.com/ssv32/PhpFileSql) ;
  -	PostgreSQL 9.2 .
  
File weight: 350 Kb (with demo data).<br/>
Database weight: 208 Kb (with demo data).

### Install gy php framework:
- You can install it with a php script from here - https://github.com/ssv32/install-gy-php-framework 
  (there is a console and graphical script), or clone this repository;
- After installation, you need to configure the gy framework core, this can be done with a script gy/install/consoleInstallOptions.php 
  (or edited file /gy/config/gy_config.php);
- Then you need to install the table into the database with a script gy/install/installDataBaseTable.php (initial creation of the database and set access and its name in the step above).

### After installation
- You can get to the admin panel from the browser like this `<your project domain>/gy/admin/` (admin admin).<br/>
- There is a demo site, you can install it with a console script `gy/install/installDemoSite1.php` (Should be sent as the first parameter `start`, example `php -f gy/install/installDemoSite1.php start`).<br/>
- The demo site is needed for a small demonstration, it includes a directory `customDir`, with an example of customizing a component template, section `classes` (for custom classes or overriding classes gy), and the main page file `index.php`.


### Documentation
<p>There are wiki pages that show how to work with gy framework. (in terms of admin panel and explanation for developers)
https://github.com/ssv32/gy/wiki </p>
<br/><br/>

### Example сonnection gy php framework
`<?`<br/>
`include "./gy/gy.php"; // подключить ядро // include core`<br/>

### Example of checking if the kernel is connected gy php framework
`<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>`

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


