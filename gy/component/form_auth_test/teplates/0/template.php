<?php // шаблон компонента // template component form_auth_test
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

if ( empty($arRes["auth_ok"]) ) :?>
    <form>
    <p><?=$this->lang->GetMessage('get-text');?></p>
        <?php 
        foreach ($arRes as $key => $value) {
        ?>
            <input type="hidden" name="idComponent" value="<?=$arParam['idComponent']?>" />
            <input type="text" name="<?=$key;?>"  />
        <?php }?>

        <input type="submit" name="<?=$this->lang->GetMessage('button');?>" value="<?=$this->lang->GetMessage('button');?>" />

    </form>	
<?php else:?>
    <h1><?=$this->lang->GetMessage('hi');?>, <?=$arRes["auth_user"];?></h1>

<?php endif;?>