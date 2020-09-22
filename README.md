<p align="center">
  <img src="gy/images/gy-icons.jpg" width="128" height="128"/>
</p>

# gy php framework
(ru):<br/>

Gy – это небольшой php framework, который включает в себя элементы cms. Нужен для создания небольших сайтов и веб проектов. 

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

### Основные цели
   Основная цель проекта gy framework/cms, сделать бесплатный, доступный всем, простой в освоение, простой в реализации и архитектуре инструмент для создания простых (небольших) сайтов.<br/><br/>
   Создаваемый инструмент должен быть максимально простым в освоение и не требующем от разработчика использующего gy каких либо сложных навыков или знаний, достаточно только основ php.<br/><br/>
   Продукт не должен быть требовательным к платформе (модулям, зависимостям, в идеале без зависимостей) и техническим аспектам сервера.<br/><br/>
   Продукт должен обеспечить наиболее лёгкий вход разработчику в веб, а в идеале должен позволять обычным людям, без опыта разработки или обладая лишь небольшими знаниями php, делать сайты.<br/><br/>
   Продукт внутри, ядро (архитектура, внутренние особенности) должен быть максимально простым, и делиться на простые части, что бы любой мог разобраться в архитектуре и вносить изменения.<br/><br/>
   Продукт не должен лицензионно и архитектурно ограничивать разработчика, а давать возможность переопределить/заменить любую часть ядра gy, либо сделать поверх необходимое. Т.е. должна быть возможность максимально просто расширяться, вплоть до полного изменения без изменения чего либо в раздела /gy/.<br/><br/>
   Продукт должен включать в себя все необходимые компоненты для создания простого сайта, а также иметь в панели администрирования необходимые настройки для работы с контентом сайта.<br/><br/>



-----
(en):

Gy – it is a small php framework that includes cms elements. Needed for creating small sites and web projects.

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

### Basic goals
   The main goal of the gy framework/cms project is to make a free, accessible to everyone, easy to learn, easy to implement and architecture tool for creating simple (small) sites.<br/><br/>
   The created tool should be as simple as possible to learn and does not require any complex skills or knowledge from the developer using gy, just the basics of php are enough.<br/><br/>
   The product should not be demanding on the platform (modules, dependencies, ideally without dependencies) and technical aspects of the server.<br/><br/>
   The product should provide the easiest entry for a developer to the web, and ideally should allow ordinary people, with no development experience or with only little knowledge of php, to create sites.<br/><br/>
   The product inside, the core (architecture, internal features) should be as simple as possible, and divided into simple parts, so that anyone can understand the architecture and make changes.<br/><br/>
   The product should not restrict the developer by license or architecture, but should provide the ability to redefine/replace any part of the gy core, or override what is needed. Those. it should be possible to expand as simply as possible, up to a complete change without changing anything in the `/gy/` section.<br/><br/>
  The product must include all the necessary components for creating a simple site, and also have the necessary settings in the administration panel to work with the site's content.<br/><br/>



