<?php if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<div class="gy-admin-panel">
    <h2 class="gy-admin-logo">Админка gy framework</h2>
    <?php
    global $app;
    if(!empty($app->options['v-gy'])){?>
        <span class="version-gy-core-admin-panel">v <?=$app->options['v-gy']?></span>
        <br/>
    <?php }?>
    <div>
        <div class="div-button-admin-panel">
            <a href="/gy/admin/" class="gy-admin-panel-button"><?=$this->lang->GetMessage('button-admin');?></a>
           
        </div>
        <div class="div-login">
            <?=$this->lang->GetMessage('hi');?><?=$arRes["auth_user"]?>
            &nbsp;
            <a 
                href="/gy/admin?<?=$this->lang->GetMessage('exit');?>=<?=$this->lang->GetMessage('exit');?>" 
                class="gy-admin-panel-button"
            >
                <?=$this->lang->GetMessage('exit');?>
            </a>
        </div>
        
    </div>
    <div class="edit-button"> <?php // TODO надо что бы была возможность добавлять кнопки из модулей?>
        <a href="/gy/admin/get-admin-page.php?page=work-page-site" class="gy-admin-edit-button"><?=$this->lang->GetMessage('button-work-page');?></a>
    </div>
</div>