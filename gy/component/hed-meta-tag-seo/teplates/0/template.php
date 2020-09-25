<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<?if(!empty($arParam['title'])){?>
    <title><?=$arParam['title']?></title>
<?}?>

<?if(!empty($arParam['descriptions'])){?>
    <meta name="descriptions" content="<?=$arParam['descriptions']?>">
<?}?>

<?if(!empty($arParam['keywords'])){?>
    <meta name="keywords" content="<?=$arParam['keywords']?>">
<?}?>
