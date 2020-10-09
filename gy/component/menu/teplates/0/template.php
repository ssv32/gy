<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

if ($arParam['buttons']) {?>
    <div class="gy-admin-menu">
        <?php foreach ($arParam['buttons'] as $key => $val) {?>
            <a href="<?=$val;?>" class="<?=(($val == $arRes['thisUrl'])? 'active-menu': '');?>"><?=$key;?></a>
        <?php }?>
    </div>
<?php }