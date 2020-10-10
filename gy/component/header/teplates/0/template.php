<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );
global $APP;
?>

<html>
    <head>
        <?php
        // вывести title и СЕО метатеги
        if (!empty($arParam['seo-meta-tag-head'])) {
            $APP->component(
                'hed-meta-tag-seo',
                '0',
                $arParam['seo-meta-tag-head']
            );
        }
        
        ?>
    </head>
    <body>  