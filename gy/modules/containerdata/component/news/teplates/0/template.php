<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );?>

<h3><?=$arParam['title'];?></H3>

<div class="news" >
<?php
if (!empty($arRes['ITEMS'])){ ?>
    
        <?php foreach ($arRes['ITEMS'] as $val) {?>
            <div class="item">
                
                <?php if ( $arParam['show-in-url-code'] == 1) {?>
                    <a href="<?=$arParam['this-url-dir'].$val['code']?>/" >
                <?php } else { ?>
                    <p>
                <?php }?>
                    <b><?=$val['name']?></b><br/>
                    <?=$val['property']['preview_text']['value']['value']?>
                    <br/>
                    <?=$val['property']['date']['value']['value']?>

                <?php if ( $arParam['show-in-url-code'] == 1) {?>
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

<?php } else {?>
    <div class="item">
        <p>
            <?=$this->lang->getMessage('ITEMS-NULL');?>
        </p>
    </div>
<?php }?>
</div>
    