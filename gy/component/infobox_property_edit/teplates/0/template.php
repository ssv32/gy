<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );
?>

<?if (!empty($arRes['PROPERTYS'])){?>
    <table border="1" class="gy-table-all-users">
        <tr><th>name</th><th>code</th><th>name type property</th></tr>
        <? foreach ($arRes['PROPERTYS'] as $val){?>
            <tr>
                <td><?=$val['name'];?></td>
                <td><?=$val['code'];?></td>
                <td>id= <?=$arRes['TYPE_PROPERTYS'][$val['id_type_property']]['id']?> name= <?=$arRes['TYPE_PROPERTYS'][$val['id_type_property']]['name']?></td>
            </tr>
        <?}?>
    </table>
<?}else{?>
    <?=$this->lang->GetMessage('not-property');?>
    <br/>
<?}?>

<?if(!empty($arRes['status'])){?>    
    <?if ($arRes['status'] == 'add-ok'){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('add-ok');?></div>
        <br/>
    <? } ?>

    <?if ($arRes['status'] == 'add-err'){?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage('add-err');?></div>
        <br/>
    <? } ?>
    
    <?if ($arRes['status'] == 'add-err-not-type'){?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage('add-err-not-type');?></div>
        <br/>
    <? } ?>
<?}?>    
    
<form method="post" >    
    <h4><?=$this->lang->GetMessage('title-add-property');?></h4>
    <table border="1" class="gy-table-all-users">
        <tr>
            <td>
                тип свойства
            </td>
            <td>
                <select name="type_property">
                    <option  value="null"></option>
                    <? foreach ($arRes['TYPE_PROPERTYS'] as $val){?>
                        <option  value="<?=$val['id']?>"><?=$val['name']?></option> 
                    <?}?>
                </select>
            </td>
        </tr>
        <tr><td>name</td><td><input type="text" name="name" /></td></tr>
        <tr><td>code</td><td><input type="text" name="code" /></td></tr>    
   
    </table>
    <input type="submit" class="gy-admin-button" value="<?=$this->lang->GetMessage('add-property');?>" />
</form>

    
