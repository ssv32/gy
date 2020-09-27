<?php // шаблон компонента // template component form_auth
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

if ( empty($arRes["auth_ok"]) ) :?>
    <form>
        <input type="hidden" name="idComponent" value="<?=$arParam['idComponent']?>" />

        <?php foreach ($arRes['form_input'] as $key => $value) { ?>
            <input type="<?=(($key == 'pass')? 'password': 'text');?>" name="<?=$key;?>"  /><br/>
        <?php }?>

        <?php // показать капчу
        global $app;
        $app->component(
            'capcha',
            '0',
            array( 
            )
        );?>
            
        <?php if ( !empty($arRes['err']) ){?>
            <div class="gy-admin-error-message"><?=$this->lang->GetMessage($arRes['err']);?></div>
        <?php }?>	
		
        <input class="gy-admin-button" type="submit" name="<?=$this->lang->GetMessage('button');?>" value="<?=$this->lang->GetMessage('button');?>" />
        
    </form>	
<?php else:?>
    <h1><?=$this->lang->GetMessage('hi');?>, <?=$arRes["auth_user"];?></h1>
    <form>
        <input class="gy-admin-button" type="submit" name="<?=$this->lang->GetMessage('exit');?>" value="<?=$this->lang->GetMessage('exit');?>" />
    </form>
<?php endif;?>