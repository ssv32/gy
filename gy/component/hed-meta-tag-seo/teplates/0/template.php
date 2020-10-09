<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );?>

<?php if (!empty($arParam['title'])) {?>
    <title><?=$arParam['title']?></title>
<?php }?>

<?php if (!empty($arParam['descriptions'])) {?>
    <meta name="descriptions" content="<?=$arParam['descriptions']?>">
<?php }?>

<?php if (!empty($arParam['keywords'])) {?>
    <meta name="keywords" content="<?=$arParam['keywords']?>">
<?php }?>
