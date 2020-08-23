<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->GetMessage('title');?><?=$arParam['id-user']?></h1>

<?if (!empty($arRes['stat']) ){?>
    <?if ( $arRes['stat'] == 'ok'){ ?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('stat-ok');?></div>
        <br/>
    <?}?>

    <?if ($arRes['stat'] == 'err'){?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage('stat-err');?></div>
        <br/>
    <?}?>
    <a href="/gy/admin/edit-users-propertys.php?edit-id=<?=$arParam['id-user']?>" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<?}else{?>

    <form method="post" >

        <input type="hidden" name="id-user" value="<?=$arParam['id-user']?>" />
        
        <table border="1" class="gy-table-all-users">

            <tr>
                <th><?=$this->lang->GetMessage('name-property');?></th>
                <th><?=$this->lang->GetMessage('value-property');?></th>
            </tr>
            
            <? foreach ($arRes['propertys'] as $value) { ?>
                <tr>
                    <td><?=$value['name_property']?></td>
                    <td>
                        <input type="text" name="property[<?=$value['id_property']?>]" value="<?=$value['value']?>" >
                    </td> 
                </tr>    
            <?}?>

        </table>
        <input type="submit" class="gy-admin-button" value="<?=$this->lang->GetMessage('save');?>" />
    </form>
    
<?}?>
        