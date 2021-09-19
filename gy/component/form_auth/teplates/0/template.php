<?php // шаблон компонента // template component form_auth
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

if (empty($arRes["auth_ok"])) :?>
    <form>
        <input type="hidden" name="idComponent" value="<?=$arParam['idComponent']?>" />
        <?if (!empty($_REQUEST['secretKeyAdminPanel'])) { ?>
            <input type="hidden" name="secretKeyAdminPanel" value="<?=$_REQUEST['secretKeyAdminPanel']?>" />
        <?}?>
        
        <?php foreach ($arRes['form_input'] as $key => $value) { ?>
            <input type="<?=(($key == 'pass')? 'password': 'text');?>" name="<?=$key;?>"  /><br/>
        <?php }?>

        <?php // показать капчу
        global $APP;
        $APP->component(
            'capcha',
            '0',
            array( 
            )
        );?>
            
        <?php if (!empty($arRes['err'])) {?>
            <div class="gy-admin-error-message"><?=$this->lang->getMessage($arRes['err']);?></div>
        <?php }?>

        <input class="gy-admin-button" type="submit" name="<?=$this->lang->getMessage('button');?>" value="<?=$this->lang->getMessage('button');?>" />
        
    </form>
<?php else:?>
    <h1><?=$this->lang->getMessage('hi');?>, <?=$arRes["auth_user"];?></h1>
    <form>
        <input class="gy-admin-button" type="submit" name="<?=$this->lang->getMessage('exit');?>" value="<?=$this->lang->getMessage('exit');?>" />
    </form>
<?php endif;?>