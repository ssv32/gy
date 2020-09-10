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
            
            // записать основную страницу
            file_put_contents(__DIR__.'/../../index.php', getCodeByUrlPage('index.php'));
            
            mkdir(__DIR__.'/../../customDir/component/containerdata_element_show/teplates/0/', 0755, true);
            mkdir(__DIR__.'/../../customDir/classes/', 0755, true);
            
            // записать файлы /customDir
            file_put_contents(__DIR__.'/../../customDir\component\containerdata_element_show\teplates\0\template.php', getCodeByUrlPage('customDir\component\containerdata_element_show\teplates\0\template.php'));
            file_put_contents(__DIR__.'/../../customDir\component\containerdata_element_show\teplates\0\style.css', getCodeByUrlPage('customDir\component\containerdata_element_show\teplates\0\style.css'));
            file_put_contents(__DIR__.'/../../customDir\component\containerdata_element_show\teplates\0\lang_template.php', getCodeByUrlPage('customDir\component\containerdata_element_show\teplates\0\lang_template.php'));

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

function getCodeByUrlPage($page){
    $arrayCodeByUrl = array(
        'index.php' => '<? include $_SERVER["DOCUMENT_ROOT"]."/gy/gy.php"; // подключить ядро // include core 

            $app->component(
                \'admin-button-public-site\',
                \'0\',
                array()
            );

            $app->component(
                \'includeHtml\',
                \'0\',
                array(
                    \'html\' => \'<h1>Пример использования gy CMS/framework</h1>\'
                )
            );

            // пример вызова одинаковых компонентов // example run two component 
            $app->component(
                \'includeHtml\',
                \'0\',
                array(
                    \'html\' => \'<h4>Вызов компонента "form_auth_test" (1 раз)</h4>\'
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
                    \'html\' => \'<h4>Вызов компонента "form_auth_test" (2 раз)</h4>\'
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
'
    );
    
    return $arrayCodeByUrl[$page];
}

