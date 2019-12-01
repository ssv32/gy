<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

if (!empty($arRes['data-this-nfo-box'][0])){
    ?>
    <h1><?=$this->lang->GetMessage('title');?></h1>
    <form method="post">
        <input name="ID" type="hidden" value="<?=$arRes['data-this-nfo-box'][0]['id']?>" />
        <table border="1" class="gy-table-all-users">
            <? foreach ($arRes['property'] as $val){?>
                <tr>
                    <td><?=$val?></td>
                    <td><input type="text" name="<?=$val?>" value="<?=$arRes['data-this-nfo-box'][0][$val]?>" /></td>
                </tr>
            <?}?>
        </table> 
        
        <input type="submit" class="gy-admin-button" value="<?=$this->lang->GetMessage('save');?>" />
    </form>    
    <br/>
    <a href="" class="gy-admin-button"><?=$this->lang->GetMessage('back');?></a>
    <br/>
    <br/>
    <br/>
    <a href="/gy/admin/container-data-property-edit.php?container-data-id=<?=$arRes['data-this-nfo-box'][0]['id']?>" class="gy-admin-button"><?=$this->lang->GetMessage('edit-property');?></a>
<?}?>    
   
<?if(!empty($arRes['status'])){?>    
    <?if ($arRes['status'] == 'add-ok'){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('add-ok');?></div>
        <br/>
        <a href="/gy/admin/container-data.php" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
    <? } ?>

    <?if ($arRes['status'] == 'add-err'){?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage('add-err');?></div>
        <br/>
        <a href="/gy/admin/container-data.php" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
    <? } ?>
<?}?>