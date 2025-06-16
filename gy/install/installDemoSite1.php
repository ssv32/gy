<?php
/**
 * Скрипт установит демо сайт 
 * 
 */

use Gy\Modules\containerdata\Classes\ContainerData;

global $argv;
$isRunConsole = isset($argv);
$br = "\n";

if ($isRunConsole) {
    if ($argv[1] == 'start') {

        if (!file_exists(__DIR__.'/../../index.php')) {
	
            include $_SERVER["DOCUMENT_ROOT"]."/../gy.php"; // подключить ядро // include core 

            // TODO брать из ядра настройки, выбранный язык
//            include(__DIR__.'/../../gy/config/gy_config.php'); // подключение настроек ядра // include options
//            if (!empty($gyConfig['lang']) && in_array($gyConfig['lang'], array('rus', 'eng'))) {
//                $lang = $gyConfig['lang'];
//            } else {
//                $lang = 'rus';
//            }
            
            
            // записать основную страницу
            file_put_contents(__DIR__.'/../../index.php', getCodeByUrlPage('index.php', $lang));

            mkdir(__DIR__.'/../../customDir/component/containerdata_element_list/teplates/menu/', 0755, true);
            mkdir(__DIR__.'/../../customDir/component/containerdata_element_property/teplates/1/', 0755, true);
            mkdir(__DIR__.'/../../customDir/component/containerdata_element_show/teplates/footer_text/', 0755, true);
            mkdir(__DIR__.'/../../customDir/component/containerdata_element_show/teplates/header_title_h1_menu/', 0755, true);
            mkdir(__DIR__.'/../../customDir/component/containerdata_element_show/teplates/show_block_site', 0755, true);
            mkdir(__DIR__.'/../../customDir/component/containerdata_element_show/teplates/text/', 0755, true);
            mkdir(__DIR__.'/../../customDir/component/header/teplates/header_example_site/', 0755, true);
            mkdir(__DIR__.'/../../customDir/component/includeHtml/teplates/block_content/', 0755, true);
            
            mkdir(__DIR__.'/../../html/', 0755, true);
            mkdir(__DIR__.'/../../documentation-for-content-manager/', 0755, true);
            
   
            // записать файлы /customDir
            file_put_contents(__DIR__.'/../../customDir/component/containerdata_element_list/teplates/menu/template.php', getCodeByUrlPage('./customDir/component/containerdata_element_list/teplates/menu/template.php', $lang));
            file_put_contents(__DIR__.'/../../customDir/component/containerdata_element_property/teplates/1/template.php', getCodeByUrlPage('./customDir/component/containerdata_element_property/teplates/1/template.php', $lang));
            file_put_contents(__DIR__.'/../../customDir/component/containerdata_element_show/teplates/footer_text/template.php', getCodeByUrlPage('./customDir/component/containerdata_element_show/teplates/footer_text/template.php', $lang));
            file_put_contents(__DIR__.'/../../customDir/component/containerdata_element_show/teplates/header_title_h1_menu/template.php', getCodeByUrlPage('./customDir/component/containerdata_element_show/teplates/header_title_h1_menu/template.php', $lang));
            file_put_contents(__DIR__.'/../../customDir/component/containerdata_element_show/teplates/show_block_site/template.php', getCodeByUrlPage('./customDir/component/containerdata_element_show/teplates/show_block_site/template.php', $lang));
            file_put_contents(__DIR__.'/../../customDir/component/containerdata_element_show/teplates/text/template.php', getCodeByUrlPage('./customDir/component/containerdata_element_show/teplates/text/template.php', $lang));
            file_put_contents(__DIR__.'/../../customDir/component/header/teplates/header_example_site/template.php', getCodeByUrlPage('./customDir/component/header/teplates/header_example_site/template.php', $lang));
            file_put_contents(__DIR__.'/../../customDir/component/includeHtml/teplates/block_content/template.php', getCodeByUrlPage('./customDir/component/includeHtml/teplates/block_content/template.php', $lang));
            
            file_put_contents(__DIR__.'/../../html/index.html', getCodeByUrlPage('./html/index.html', $lang));
            file_put_contents(__DIR__.'/../../html/main.css', getCodeByUrlPage('./html/main.css', $lang));
            
            file_put_contents(__DIR__.'/../../documentation-for-content-manager/index.php', getCodeByUrlPage('./documentation-for-content-manager/index.php', $lang));
            
            global $DB;

            // добавить контейнер данных - Блоки сайта
            ContainerData::addContainerData(array('code'=> 'site_block','name'=> 'Блоки сайта'));

            $dataContentContainerData = ContainerData::getContainerData(array('=' => array('code', "'site_block'")), array('*'));

            //добавить свойство
            ContainerData::addPropertyContainerData(
                array(
                    'id_type_property' => 1,
                    'id_container_data' => $dataContentContainerData[0]['id'],
                    'code' => 'text_block',
                    'name' => 'текст блока'
                )
            );

            // добавить элемент контейнера данных text_block_1
            ContainerData::addElementContainerData(
                array(
                    'section_id' => 0,
                    'code' => 'text_block_1',
                    'name' => 'Текст блок 1',
                    'id_container_data' => $dataContentContainerData[0]['id']
                )
            );
            ContainerData::addElementContainerData(
                array(
                    'section_id' => 0,
                    'code' => 'text_block_2',
                    'name' => 'Текст блок 2',
                    'id_container_data' => $dataContentContainerData[0]['id']
                )
            );
            ContainerData::addElementContainerData(
                array(
                    'section_id' => 0,
                    'code' => 'title_h1',
                    'name' => 'Заголовок h1',
                    'id_container_data' => $dataContentContainerData[0]['id']
                )
            );
            ContainerData::addElementContainerData(
                array(
                    'section_id' => 0,
                    'code' => 'footer_text',
                    'name' => 'Текст в футоре',
                    'id_container_data' => $dataContentContainerData[0]['id']
                )
            );

            // взять типы свойств что бы знать названия таблиц где их искать
            $dataTypeProperty = ContainerData::getAllTypePropertysContainerData();
            
            // найти элемент
            $dataElement1 = ContainerData::getElementContainerData(
                array(
                    'AND' => array(
                        array( '=' => array( 'id_container_data', $dataContentContainerData[0]['id']) ),
                        array( '=' => array( 'code', "'text_block_1'"))
                    )
                )
            );
            $dataElement2 = ContainerData::getElementContainerData(
                array(
                    'AND' => array(
                        array( '=' => array( 'id_container_data', $dataContentContainerData[0]['id']) ),
                        array( '=' => array( 'code', "'text_block_2'"))
                    )
                )
            );
            $dataElement3 = ContainerData::getElementContainerData(
                array(
                    'AND' => array(
                        array( '=' => array( 'id_container_data', $dataContentContainerData[0]['id']) ),
                        array( '=' => array( 'code', "'title_h1'"))
                    )
                )
            );
            $dataElement4 = ContainerData::getElementContainerData(
                array(
                    'AND' => array(
                        array( '=' => array( 'id_container_data', $dataContentContainerData[0]['id']) ),
                        array( '=' => array( 'code', "'footer_text'"))
                    )
                )
            );

            // найти его свойства
            $propertyContainerData = ContainerData::getPropertysContainerData(
                array(
                    '='=>array(
                        'id_container_data', 
                        $dataContentContainerData[0]['id']
                    ) 
                ) 
            );
            
            $prop = array_shift($propertyContainerData);

            
            // добавить значение свойства для элемента созданного выше
            ContainerData::addValuePropertyContainerData(
                $dataContentContainerData[0]['id'],
                $dataElement1['id'],
                $prop['id'],
                'value_propertys_type_html',
                '<b>Gy php framework</b><br/><br/>
Gy – это небольшой php framework, который включает в себя элементы cms. Нужен для создания небольших сайтов и веб проектов.
<br/><br/>
Вы можете внести свой вклад в проект gy - framework/CMS, следующими способами:<br/>
                                        <ul class="list">
                                            <li>сообщить о баге/проблеме безопасности;</li>
                                            <li>сообщить о неточности/опечатки;</li>
                                            <li>помочь в разработке;</li>
                                            <li>можете предложить как можно улучшить продукт;</li>
                                            <li>или поделиться с друзьями, в соц. сетях/устно словами.</li>
                                        </ul>
<br/>
Сайт проекта <a href="https://asisg.ru/projects/gy/">https://asisg.ru/projects/gy/</a>
<br/><br/>
Проект и подробная информация находится тут <a href="https://github.com/ssv32/gy" target="_blank">https://github.com/ssv32/gy</a>
<br/><br/>
Wiki проекта находтся тут <a href="https://github.com/ssv32/gy/wiki" target="_blank">https://github.com/ssv32/gy/wiki</a>
<br/><br/>
'
            );
            ContainerData::addValuePropertyContainerData(
                $dataContentContainerData[0]['id'],
                $dataElement2['id'],
                $prop['id'],
                'value_propertys_type_html',
                '<b>Основные цели gy framework</b><br/><br/>
Основная цель проекта gy framework/cms, сделать бесплатный, доступный всем, простой в освоение, простой в реализации и архитектуре инструмент для создания простых (небольших) сайтов.
<br/><br/>
Создаваемый инструмент должен быть максимально простым в освоение и не требующем от разработчика использующего gy каких либо сложных навыков или знаний, достаточно только основ php.
<br/><br/>
Продукт не должен быть требовательным к платформе (модулям, зависимостям, в идеале без зависимостей) и техническим аспектам сервера.
<br/><br/>
Продукт должен обеспечить наиболее лёгкий вход разработчику в веб, а в идеале должен позволять обычным людям, без опыта разработки или обладая лишь небольшими знаниями php, делать сайты.
<br/><br/>
Продукт внутри, ядро (архитектура, внутренние особенности) должен быть максимально простым, и делиться на простые части, что бы любой мог разобраться в архитектуре и вносить изменения.
<br/><br/>
Продукт не должен лицензионно и архитектурно ограничивать разработчика, а давать возможность переопределить/заменить любую часть ядра gy, либо сделать поверх необходимое. Т.е. должна быть возможность максимально просто расширяться, вплоть до полного изменения без изменения чего либо в раздела /gy/.
<br/><br/>
Продукт должен включать в себя все необходимые компоненты для создания простого сайта, а также иметь в панели администрирования необходимые настройки для работы с контентом сайта.
<br/>'
            );
            ContainerData::addValuePropertyContainerData(
                $dataContentContainerData[0]['id'],
                $dataElement3['id'],
                $prop['id'],
                'value_propertys_type_html',
                'Пример использования gy CMS/framework<br/>Демо сайт 1'
            );
            ContainerData::addValuePropertyContainerData(
                $dataContentContainerData[0]['id'],
                $dataElement4['id'],
                $prop['id'],
                'value_propertys_type_html',
                'Пример использования gy CMS/framework<br/>Демо сайт 1<br/>'.date('Y').' г.'
            );

            // добавить контейнер данных - Блоки сайта
            ContainerData::addContainerData(array('code'=> 'menu','name'=> 'Меню'));

            $dataContentContainerData = ContainerData::getContainerData(array('=' => array('code', "'menu'")), array('*'));

            //добавить свойство
            ContainerData::addPropertyContainerData(
                array(
                    'id_type_property' => 1,
                    'id_container_data' => $dataContentContainerData[0]['id'],
                    'code' => 'name_url',
                    'name' => 'Название ссылки'
                )
            );
            ContainerData::addPropertyContainerData(
                array(
                    'id_type_property' => 1,
                    'id_container_data' => $dataContentContainerData[0]['id'],
                    'code' => 'url',
                    'name' => 'url'
                )
            );
//
//            // добавить элемент контейнера данных text_block_1
            ContainerData::addElementContainerData(
                array(
                    'section_id' => 0,
                    'code' => 'page1',
                    'name' => 'Главная',
                    'id_container_data' => $dataContentContainerData[0]['id']
                )
            );
            
            
            ContainerData::addElementContainerData(
                array(
                    'section_id' => 0,
                    'code' => 'documentation-for-content-manager',
                    'name' => 'Документация для контент-менеджера (по текущему демо сайту)',
                    'id_container_data' => $dataContentContainerData[0]['id']
                )
            );
            
            ContainerData::addElementContainerData(
                array(
                    'section_id' => 0,
                    'code' => 'page2',
                    'name' => 'Страница 2',
                    'id_container_data' => $dataContentContainerData[0]['id']
                )
            );
            
            

            // взять типы свойств что бы знать названия таблиц где их искать
            $dataTypeProperty = ContainerData::getAllTypePropertysContainerData();
            
            // найти элемент
            $dataElement1 = ContainerData::getElementContainerData(
                array(
                    'AND' => array(
                        array( '=' => array( 'id_container_data', $dataContentContainerData[0]['id']) ),
                        array( '=' => array( 'code', "'page1'"))
                    )
                )
            );
            $dataElement2 = ContainerData::getElementContainerData(
                array(
                    'AND' => array(
                        array( '=' => array( 'id_container_data', $dataContentContainerData[0]['id']) ),
                        array( '=' => array( 'code', "'page2'"))
                    )
                )
            );
            $dataElement3 = ContainerData::getElementContainerData(
                array(
                    'AND' => array(
                        array( '=' => array( 'id_container_data', $dataContentContainerData[0]['id']) ),
                        array( '=' => array( 'code', "'documentation-for-content-manager'"))
                    )
                )
            );

            // найти его свойства
            $propertyContainerData = ContainerData::getPropertysContainerData(
                array(
                    '='=>array(
                        'id_container_data', 
                        $dataContentContainerData[0]['id']
                    ) 
                ) 
            );
            
            foreach ($propertyContainerData as $val) {
                if  ($val['code'] == 'name_url') {
                    $prop1Id = $val['id'];
                }
                if  ($val['code'] == 'url') {
                    $prop2Id = $val['id'];
                }
            }
            
            // добавить значение свойства для элемента созданного выше
            ContainerData::addValuePropertyContainerData(
                $dataContentContainerData[0]['id'],
                $dataElement1['id'],
                $prop1Id,
                'value_propertys_type_html',
                'Главная'
            );
            ContainerData::addValuePropertyContainerData(
                $dataContentContainerData[0]['id'],
                $dataElement1['id'],
                $prop2Id,
                'value_propertys_type_html',
                '/'
            );
            
            ContainerData::addValuePropertyContainerData(
                $dataContentContainerData[0]['id'],
                $dataElement3['id'],
                $prop1Id,
                'value_propertys_type_html',
                'Документация для контент-менеджера (по текущему демо сайту)'
            );
            ContainerData::addValuePropertyContainerData(
                $dataContentContainerData[0]['id'],
                $dataElement3['id'],
                $prop2Id,
                'value_propertys_type_html',
                '/documentation-for-content-manager/'
            );
            
            ContainerData::addValuePropertyContainerData(
                $dataContentContainerData[0]['id'],
                $dataElement2['id'],
                $prop1Id,
                'value_propertys_type_html',
                'Сайт проекта asisg.ru'
            );
            ContainerData::addValuePropertyContainerData(
                $dataContentContainerData[0]['id'],
                $dataElement2['id'],
                $prop2Id,
                'value_propertys_type_html',
                'https://asisg.ru/projects/gy/'
            );
           

            
            echo 'Install = OK!'; 
        } else {
            echo '! Did not install. The main page file already exists.';
        }
    } else {
        echo $br.'This script will install demo data and one title page. Demo site 1.';
        echo $br.'To start the installation, enter the start parameter when invoking the script in the console.';
        echo $br.'!!! Carefully the script can destroy the main page and the customDir directory !!!';
    }
} else {
    echo '! Error. You need to run the script in the console';
}

function getCodeByUrlPage($page, $lang){ 
    $arLang = array( // TODO добавить eng текст , если в установке был выбран он
        'rus' => array(
            'html-title' => 'Пример использования gy CMS/framework',
            'title-show-component' => 'Вызов компонента',
            'title-run-component' => 'Вызов компонента',
        ),
        'eng' => array(
            'html-title' => 'Usage example gy CMS/framework',
            'title-show-component' => 'Component launch',
            'title-run-component' => 'Component launch',
        )
    );

    $arrayCodeByUrl = array(
        'index.php' => '<?php include $_SERVER["DOCUMENT_ROOT"]."/gy/gy.php"; // подключить ядро // include core 

$APP->component(
    \'header\',
    \'header_example_site\',
    array(
        \'seo-meta-tag-head\' => array(
            \'title\' => \'Пример простого сайта\',
            \'descriptions\' => \'description пример простого сайта\',
            \'keywords\' => \'description пример простого сайта\'
        ) 
    )
);

$APP->component(
    \'admin-button-public-site\',
    \'0\',
    array()
);

$APP->component(
    \'containerdata_element_list\',
    \'menu\',
    array( 
        \'container-data-code\' => \'menu\',
        \'TITLE\' => array( 
            \'container-data-code\' => \'site_block\',
            \'element-code\' => \'title_h1\',
            \'cacheTime\' => 86400, // закешить на 24 ч.
        )  
    )
);  


$APP->component(
    \'includeHtml\',
    \'block_content\',
    array( 
        \'html\' => \'\',
        \'block1\' => array( 
            \'container-data-code\' => \'site_block\',
            \'element-code\' => \'text_block_1\',
            \'cacheTime\' => 86400, // закешить на 24 ч.
            \'class_name_block\' => \'block1\'
        ),
        \'block2\' => array( 
            \'container-data-code\' => \'site_block\',
            \'element-code\' => \'text_block_2\',
            \'cacheTime\' => 86400, // закешить на 24 ч.
            \'class_name_block\' => \'block2\'
        )
    )
);

$APP->component(
    \'containerdata_element_show\',
    \'footer_text\',
    array( 
        \'container-data-code\' => \'site_block\',
        \'element-code\' => \'footer_text\',
        \'cacheTime\' => 86400, // закешить на 24 ч.
    )
);

$APP->component(
    \'footer\',
    \'0\',
    array()
);
        ',
        './html/index.html' => '
<html>
    <head>
        <title>Пример простого сайта</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="description пример простого сайта"> 

        <link rel="stylesheet" href="main.css">


    </head>
    <body>
        <div class="header">
            <div class="header-h1">
                <h1>Пример простого сайта</h1>
            </div>
            <div class="menu">
                <a href="">Страница 1</a>
                <a href="page1.html">Страница 2</a>
            </div>
        </div>
        <div class="content">
            <div class="block1">
                <p>
                    Текст блок 1
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>


                </p>
            </div>
            <div class="block2">
                <p>
                    Текст блок 2
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>


                </p>
            </div>
        </div>
        <div class="footer">
            Пример простого сайта 2024
        </div>
    </body>
</html>        
        ',
        './html/main.css' => '
.header {
    background-color: #7999b0;
    text-align: center;
}
.menu{
    text-align: center;
    background-color: #ced9dd;
    padding: 20px;
    font-size: 16pt;
}
.menu a:hover{
    color: #fbfbfb;
    background-color: #98adc7;
    padding: inherit;
}
.menu a{
    padding: inherit;
}
a{
    color: #4a5f7e;
    text-decoration: initial;
}
a:hover{
    color: #252f3f;
}
.menu > a.active{
    text-decoration: underline;
}
h1 {    
    color: #e3edf6;
    padding-top: 50px;
    padding-bottom: 40px;
    font-size: 20pt;
}
body {
    margin: 0px;
    width: 100%;
    background-color: #e5edf0;
    color: #4a5f7e;
    font-size: 14pt;
    
}
.content{
    padding: 28px;
}
.content a {
    background: #d0e1ff;
}
.footer{
    background-color: #456274;
    color: #ebffff;
    text-align: center;
    padding-top: 20px;
    padding-bottom: 20px;
    font-size: 12pt;
}

        ',
        './customDir/component/containerdata_element_list/teplates/menu/template.php' => '
<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

global $APP;
?>


 <div class="header">
    <div class="header-h1">

        <h1>
            <?$APP->component(
                \'containerdata_element_show\',
                \'text\',
                $arParam[\'TITLE\']

            );?>  
        </h1>
    </div>


    <div class="menu">

        <?
        global $APP;
        foreach ($arRes[\'ITEMS\'] as $val) {
            $APP->component(
                \'containerdata_element_property\',
                \'1\',
                array( 
                    \'container-data-id\' => $val[\'id_container_data\'],
                    \'el-id\' => $val[\'id\'],
                    \'this-url\' => Gy\\Core\\Url::getThisUrlNotGetProperty()
                )
            );


        }
        ?>
    </div>

</div>
        ',
        './customDir/component/containerdata_element_property/teplates/1/template.php' => '
<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );?>


<?php

$nameUrl = array_shift($arRes[\'PROPERTY_VALUE\'])[\'value\'];
$url = array_shift($arRes[\'PROPERTY_VALUE\'])[\'value\'];
?>
<a href="<?=$url;?>" <?=(($arParam[\'this-url\'] == $url)? \'class="active"\' : \'\');?>><?=$nameUrl?></a> | 

        
        ',
        './customDir/component/containerdata_element_show/teplates/footer_text/template.php' => '
<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );
?>

<?
if (!empty($arRes[\'ITEMS\'])) { ?>

    <div class="footer">
        <?
        foreach ($arRes[\'ITEMS\'] as $value) { 
            echo ((!empty($value[\'value\']))? $value[\'value\'] : \'\');
        } 
        ?>
    </div>

<?
}
        ',
        './customDir/component/containerdata_element_show/teplates/header_title_h1_menu/template.php' => '
<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );
?>

<?
if (!empty($arRes[\'ITEMS\'])) { ?>


 <div class="header">
    <div class="header-h1">
        <?
        $title = array_shift($arRes[\'ITEMS\']);
        ?>

        <h1><?=$title[\'value\']?></h1>
    </div>

    <?
    global $APP;
    $APP->component(
        \'menu\',
        \'menu_exampal_site\',
        $arParam[\'menu\']
    );
    ?>

</div>

<?
}
        ',
        './customDir/component/containerdata_element_show/teplates/show_block_site/template.php' => '
<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );
?>

<?
if (!empty($arRes[\'ITEMS\'])) { ?>
<div class="<?=$arParam[\'class_name_block\']?>">
    <p>
    <?
    foreach ($arRes[\'ITEMS\'] as $value) { 
        echo ((!empty($value[\'value\']))? $value[\'value\'] : \'\');
    } 
    ?>
    </p>
</div>
<?
}
        ',
        './customDir/component/containerdata_element_show/teplates/text/template.php' => '
<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );
?>

<?
if (!empty($arRes[\'ITEMS\'])) { 
    foreach ($arRes[\'ITEMS\'] as $value) { 
        echo ((!empty($value[\'value\']))? $value[\'value\'] : \'\');
    } 
    ?>
<?
}
        ',
        './customDir/component/header/teplates/header_example_site/template.php' => '
<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );
global $APP;
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        // вывести title и СЕО метатеги
        if (!empty($arParam[\'seo-meta-tag-head\'])) {
            $APP->component(
                \'hed-meta-tag-seo\',
                \'0\',
                $arParam[\'seo-meta-tag-head\']
            );
        }

        ?>
        <link rel="stylesheet" href="/html/main.css">
    </head>
    <body>  
        ',
        './customDir/component/includeHtml/teplates/block_content/template.php' => '
<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

?>

<div class="content">


    <?
    global $APP;
    $APP->component(
        \'containerdata_element_show\',
        \'show_block_site\',
        $arParam[\'block1\']
    );
    ?>


    <?$APP->component(
        \'containerdata_element_show\',
        \'show_block_site\',
        $arParam[\'block2\']
    );?>  


</div>

        ',
        './documentation-for-content-manager/index.php' => '<?php
include $_SERVER["DOCUMENT_ROOT"]."/gy/gy.php"; // подключить ядро // include core 

$APP->component(
    \'header\',
    \'header_example_site\',
    array(
        \'seo-meta-tag-head\' => array(
            \'title\' => \'Пример простого сайта\',
            \'descriptions\' => \'description пример простого сайта\',
            \'keywords\' => \'description пример простого сайта\'
        ) 
    )
);

$APP->component(
    \'admin-button-public-site\',
    \'0\',
    array()
);

$APP->component(
    \'containerdata_element_list\',
    \'menu\',
    array( 
        \'container-data-code\' => \'menu\',
        \'TITLE\' => array( 
            \'container-data-code\' => \'site_block\',
            \'element-code\' => \'title_h1\',
            \'cacheTime\' => 86400, // закешить на 24 ч.
        )  
    )
);  


$APP->component(
    \'includeHtml\',
    \'0\',
    array( 
        \'html\' => \'<div class="content">
            <h3>Документация для контент-менеджера (по текущему демо сайту 1) </h3>
            <p>Нужна для редактирования выводимых данных на демо сайте 1.</p>
            <p><b>Панель администрирования</b><br/> Для изменения данных необходимо зайти в панель администрирования, для этого нужно перейти по url <a href="/gy">/gy</a> и ввести логин и пароль admin (логин и пароль по умолчанию)</p>
            <p><b>Шапка сайта</b><br/> Сейчас в шапке сайта текст “Пример использования gy&lt;br/&gt;CMS/framework&lt;/br&gt;Демо сайт 1” вы можете задать любой текст. Для этого нужно перейти в админ панели в раздел “Контейнеры данных” далее в таблице, по столбцу “name”,  найти строчку “Блоки сайта” нажать “ Работа с элементами контейнера данных” , далее по столбцу “name” найти “Заголовок h1” нажать “ Просмотреть свойства элемента” затем можно менять текст на любой, и после нажать кнопку “Сохранить”.</p>
            <p><b>Подвал сайта</b><br/>
            Текст меняется аналогично но нужен “Элементы контейнера данных” – “Текст в футоре”
            </p>
            <p>
            <b>Основное содержимое главной странице</b><br/>
            Состоит из двух блоков, меняется аналогично элементам выше только  в “Элементы контейнера данных” нужно найти “Текст блок 1” и “Текст блок 2”
            </p>
            <p>
            <b>Меню</b><br/>
            Для этого нужно перейти в админ панели в раздел “Контейнеры данных” далее в таблице, по столбцу “name”,  найти строчку “ Меню” нажать “ Работа с элементами контейнера данных”. Перед вами все пункты меню, для изменения нужно зайти в “Просмотреть свойства элемента” там будет имя и url ссылки. Также можно удалить пункты меню или добавить новые.
            </p>
            <p><b>Сброс кеша gy</b><br/>
            Для этого нужно зайти в панель администрирования далее “Настройки” и нажать кнопку “Сбросить кеш”
            </p>
        </div>
        \',    
    )
);

$APP->component(
    \'containerdata_element_show\',
    \'footer_text\',
    array( 
        \'container-data-code\' => \'site_block\',
        \'element-code\' => \'footer_text\',
        \'cacheTime\' => 86400, // закешить на 24 ч.
    )
);

$APP->component(
    \'footer\',
    \'0\',
    array()
);
        '
        
    );

    return $arrayCodeByUrl[$page];
}

