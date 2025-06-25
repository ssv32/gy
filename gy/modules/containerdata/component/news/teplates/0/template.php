<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );?>

<?php if (empty($arRes['DETAIL_NEWS'])) { ?>
    <h3><?=$arParam['title'];?></H3>
<?php } ?>

<div class="news" >
<?php
if (!empty($arRes['ITEMS'])){ ?>
    
        <?php foreach ($arRes['ITEMS'] as $val) {?>
            <div class="item">
                
                <?php if ( !empty($val['detail-url'])) {?>
                    <a href="<?=$val['detail-url']?>" >
                <?php } else { ?>
                    <p>
                <?php }?>
                    <?php if (!empty($val['property']['preview_img']['value']['value'])) {?>
                        <img src="<?=$val['property']['preview_img']['value']['value']?>" />
                        <br/>
                    <?php } ?>
                    <b><?=$val['name']?></b><br/>
                    <?=$val['property']['preview_text']['value']['value']?>
                    <br/>
                    <?=$val['property']['date']['value']['value']?>

                <?php if ( !empty($val['detail-url'])) {?>
                    </a>
                <?php } else { ?>
                    </p>
                <?php }?>
                
            </div>        
        <?php }?>
    
    <?php
    if (!empty($arRes['HTML-CODE-PAGINATION'])){ ?>
        <div class="item">
            <p>
                <?=$arRes['HTML-CODE-PAGINATION'];?>
            </p>
        </div>
    <?php 
    }
    ?>

<?php } elseif (!empty($arRes['DETAIL_NEWS'])) {?>
    
    <div class="item"> 
        <p>
            <?php if (!empty($arRes['DETAIL_NEWS']['property']['detailed_img']['value']['value'])) {?>
                <img src="<?=$arRes['DETAIL_NEWS']['property']['detailed_img']['value']['value']?>" />
                <br/>
            <?php } ?>
            <b><?=$arRes['DETAIL_NEWS']['name']?></b><br/>
            <?=$arRes['DETAIL_NEWS']['property']['date']['value']['value']?><br/><br/>
            <?=$arRes['DETAIL_NEWS']['property']['detailed_text']['value']['value']?>
            <br/>
        </p>
    </div>  
    
<?php } else {?>
    <div class="item">
        <p>
            <?=$this->lang->getMessage('ITEMS-NULL');?>
        </p>
    </div>
<?php } ?>
</div>
    