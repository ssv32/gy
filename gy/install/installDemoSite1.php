<? 
/**
 * Скрипт установит демо сайт 
 * 
 */

global $argv;
$isRunConsole = isset($argv);
$br = "\n";

if($isRunConsole){
    if($argv[1] == 'start'){
                
        if (!file_exists(__DIR__.'/../../index.php')) {
            
            define("GY_CORE", true); // хак
            include(__DIR__.'/../../gy/config/gy_config.php'); // подключение настроек ядра // include options
            if(!empty($gy_config['lang']) && in_array($gy_config['lang'], array('rus', 'eng'))){
                $lang = $gy_config['lang'];
            }else{
                $lang = 'rus';
            }
            
            // записать основную страницу
            file_put_contents(__DIR__.'/../../index.php', getCodeByUrlPage('index.php', $lang));
            
            mkdir(__DIR__.'/../../customDir/component/containerdata_element_show/teplates/0/', 0755, true);
            mkdir(__DIR__.'/../../customDir/classes/', 0755, true);
            
            // записать файлы /customDir
            file_put_contents(__DIR__.'/../../customDir\component\containerdata_element_show\teplates\0\template.php', getCodeByUrlPage('customDir\component\containerdata_element_show\teplates\0\template.php', $lang));
            file_put_contents(__DIR__.'/../../customDir\component\containerdata_element_show\teplates\0\style.css', getCodeByUrlPage('customDir\component\containerdata_element_show\teplates\0\style.css', $lang));
            file_put_contents(__DIR__.'/../../customDir\component\containerdata_element_show\teplates\0\lang_template.php', getCodeByUrlPage('customDir\component\containerdata_element_show\teplates\0\lang_template.php', $lang));

            echo 'Install = OK!';
        }else{
            echo '! Did not install. The main page file already exists.';
        }
    } else{
        echo $br.'This script will install demo data and one title page. Demo site 1.';
        echo $br.'To start the installation, enter the start parameter when invoking the script in the console.';
        echo $br.'!!! Carefully the script can destroy the main page and the customDir directory !!!';
    }
}else{
    echo '! Error. You need to run the script in the console';
}

function getCodeByUrlPage($page, $lang){
    $arLang = array(
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
        'index.php' => '<? include $_SERVER["DOCUMENT_ROOT"]."/gy/gy.php"; // подключить ядро // include core 

            $app->component(
                \'header\',
                \'0\',
                array(
                    \'seo-meta-tag-head\' => array(
                        \'title\' => \'Gy - framework/CMS, demo site 1\',
                        \'descriptions\' => \'Test text gy - framework/CMS demo site 1 meta descriptions\',
                        \'keywords\' => \'gy, framework, CMS, demo, site, site 1\'
                    ) 
                )
            );

            $app->component(
                \'admin-button-public-site\',
                \'0\',
                array()
            );

            $app->component(
                \'includeHtml\',
                \'0\',
                array(
                    \'html\' => \'<h1>'.$arLang[$lang]['html-title'].'</h1>\'
                )
            );

            // пример вызова одинаковых компонентов // example run two component 
            $app->component(
                \'includeHtml\',
                \'0\',
                array(
                    \'html\' => \'<h4>'.$arLang[$lang]['title-show-component'].' "form_auth_test" (№ 1)</h4>\'
                )
            );

            $app->component(
                \'form_auth_test\',
                \'0\',
                array( 
                    \'test\' => \'asd\',
                    \'idComponent\' => 1,
                )
            );

             // пример вызова одинаковых компонентов // example run two component 
            $app->component(
                \'includeHtml\',
                \'0\',
                array(
                    \'html\' => \'<h4>'.$arLang[$lang]['title-run-component'].' "form_auth_test" (№ 2)</h4>\'
                )
            );

            $app->component(
                \'form_auth_test\',
                \'0\',
                array( 
                    \'test\' => \'asd2\',
                    \'idComponent\' => 2,
                )
            );

            /**
            пример вызова компонента с выводом контента,
              + пример использования кастомного (пользовательского) шаблона компонента
              (пользователя - разработчика использующего gy)
            */
            $app->component(
                \'containerdata_element_show\',
                \'0\',
                array( 
                    \'container-data-code\' => \'Content\',
                    \'element-code\' => \'html-index-page\',
                    \'cacheTime\' => 86400 // закешить на 24 ч.
                )
            );

            $app->component(
                \'footer\',
                \'0\',
                array()
            );

        ',
        'customDir\component\containerdata_element_show\teplates\0\template.php' => '<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<div class="user_custom_div">
    
    <?if(!empty($arRes[\'ITEMS\'])){?>
        <? foreach ($arRes[\'ITEMS\'] as $value) { ?>
            <?=((!empty($value[\'value\']))? $value[\'value\'] : \'\');?>
        <?}?> 
    <?}?>    
    
    <br/>(<?=$this->lang->GetMessage(\'add-custom-text\');?>)
      
</div>',
        'customDir\component\containerdata_element_show\teplates\0\style.css' => '.user_custom_div{
    background-color: #21a2ff; 
    color: #05ff07;
}',
        'customDir\component\containerdata_element_show\teplates\0\lang_template.php' => '<? // языковой файл для шаблона компонента
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

$mess[\'rus\'] = array(
    \'add-custom-text\' => \'Сейчас запущен кастомный (пользовательский) шаблон компонента\'
);

$mess[\'eng\'] = array(
    \'add-custom-text\' => \'The custom (custom) component template outputs this text to you\'
);
'
    );
    
    return $arrayCodeByUrl[$page];
}

