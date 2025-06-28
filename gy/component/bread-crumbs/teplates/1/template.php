<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );?>

<?php if (!empty($arParam['items'])) { ?>   
    <div class="bread-crumbs">
        <?php 
        $i = 0;
        foreach ($arParam['items'] as $url => $item) { 
            if ($i > 0) { ?> / <?php }?>
            
            <?php if ($arRes['this-url'] == $url ) {?>
                <span class="bread-crumbs-item">
            <?php } else{?>
                <a class="bread-crumbs-item" href="<?=$url?>" >
            <?php } ?>
                <?=$item?>  
            <?php if ($arRes['this-url'] == $url) {?>
                </span>
            <?php } else{?>
                </a>
            <?php } ?>
                           
        <?php
            $i++;
        } 
        ?>
    </div>
<?php } ?>
