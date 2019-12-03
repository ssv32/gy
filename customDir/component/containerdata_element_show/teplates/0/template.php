<?if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>

<div style="background-color: #21a2ff; color: #05ff07;">
    
    <?if(!empty($arRes['ITEMS'])){?>
        <? foreach ($arRes['ITEMS'] as $value) { ?>
            <?=((!empty($value['value']))? $value['value'] : '');?>
        <?}?> 
    <?}?>    
    
    <br/>(<?=$this->lang->GetMessage('add-custom-text');?>)
    
    
</div>