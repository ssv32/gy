<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );
global $app;
?>

<html>
    <head>
        <?
        // вывести title и СЕО метатеги
        if(!empty($arParam['seo-meta-tag-head'])){
            $app->component(
                'hed-meta-tag-seo',
                '0',
                $arParam['seo-meta-tag-head']
            );
        }
        
        ?>
    </head>
    <body>  