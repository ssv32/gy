<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );
?>

<?
if(empty($arRes['status'])){?>

    <?if (!empty($arRes['PROPERTYS'])){?>
        <table border="1" class="gy-table-all-users">
            <tr><th>id</th><th>name</th><th>code</th><th>name type property</th><th></th></tr>
            <? foreach ($arRes['PROPERTYS'] as $val){?>
                <tr>
                    <td><?=$val['id'];?></td>
                    <td><?=$val['name'];?></td>
                    <td><?=$val['code'];?></td>
                    <td>type= <?=$arRes['TYPE_PROPERTYS'][$val['id_type_property']]['id']?> name= <?=$arRes['TYPE_PROPERTYS'][$val['id_type_property']]['name']?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="del-property-id" value="<?=$val['id'];?>" />
                            <input type="hidden" name="del-proprty-container-data" value="<?=$arParam['container-data-id']?>" />
                            <input type="submit" class="gy-admin-button" value="<?=$this->lang->GetMessage('del-btn')?>"  name="<?=$this->lang->GetMessage('del-btn')?>" />
                        </form>
                    </td>
                </tr>
            <?}?>
        </table>
    <?}else{?>
        <?=$this->lang->GetMessage('not-property');?>
        <br/>
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

    
<?}else{?>    
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
    
    <?if ($arRes['status'] == 'del-property-ok'){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('del-property-ok');?></div>
        <br/>
    <? } ?>
    <a href="<?=$_SERVER['REQUEST_URI']?>" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<?}?>    
  
    
