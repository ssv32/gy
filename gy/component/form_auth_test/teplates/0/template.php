<?php // шаблон компонента // template component form_auth_test
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

if ( empty($arRes["auth_ok"]) ) :?>
    <form>
    <p><?=$this->lang->getMessage('get-text');?></p>
        <?php 
        foreach ($arRes as $key => $value) {
        ?>
            <input type="hidden" name="idComponent" value="<?=$arParam['idComponent']?>" />
            <input type="text" name="<?=$key;?>"  />
        <?php }?>

        <input type="submit" name="<?=$this->lang->getMessage('button');?>" value="<?=$this->lang->getMessage('button');?>" />

    </form>	
<?php else:?>
    <h1><?=$this->lang->getMessage('hi');?>, <?=$arRes["auth_user"];?></h1>

<?php endif;?>