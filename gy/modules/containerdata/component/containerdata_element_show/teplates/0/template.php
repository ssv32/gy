<?if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>

<?if(!empty($arRes['ITEMS'])){?>
    <? foreach ($arRes['ITEMS'] as $value) { ?>
        <?=((!empty($value['value']))? $value['value'] : '');?>
    <?}?> 
<?}?>    