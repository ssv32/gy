<?if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>

<div class="gy-admin-panel">
    <h2 class="gy-admin-logo">Админка gy framework</h2>
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
</div>