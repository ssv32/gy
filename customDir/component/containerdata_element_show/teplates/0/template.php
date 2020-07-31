<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<div class="user_custom_div">
    
    <?if(!empty($arRes['ITEMS'])){?>
        <? foreach ($arRes['ITEMS'] as $value) { ?>
            <?=((!empty($value['value']))? $value['value'] : '');?>
        <?}?> 
    <?}?>    
    
    <br/>(<?=$this->lang->GetMessage('add-custom-text');?>)
      
</div>