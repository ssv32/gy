<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->GetMessage('title');?></h1>

<?if (!empty($arRes['stat']) ){?>
    <?if ( $arRes['stat'] == 'ok'){ ?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('stat-ok');?></div>
        <br/>
    <?}?>

    <?if ($arRes['stat'] == 'err'){?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage('stat-err');?></div>
        <br/>
    <?}?>
    <a href="edit-all-users-propertys.php" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<?}else{?>

    <?if($arRes['allUsersCreatePropertys']){?>
        <table border="1" class="gy-table-all-users">
            <tr>
                <th>id</th>
                <th><?=$this->lang->GetMessage('name');?></th>
                <th><?=$this->lang->GetMessage('type');?></th>
                <th><?=$this->lang->GetMessage('code');?></th>
                <th></th>
            </tr>

                <?foreach ($arRes['allUsersCreatePropertys'] as $key => $val){?>
                    <tr>
                        <td><?=$val['id'];?></td>
                        <td><?=$val['name_property'];?></td>
                        <td><?=$val['type_property'];?></td>
                        <td><?=$val['code'];?></td>

                        <td>  
                            <br/>
                            <a href="?del-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('del-property');?></a>
                            <br/>
                            <br/>
                        </td>
                    </tr>
                <?}?>

        </table>
    <?}else{?>
        <?=$this->lang->GetMessage('not-propertys');?>
    <?}?>
    
    <br/>
    <br/>
    
    <?if (!empty($arRes['allTypePropertys'])){?>
    
        <h3><?=$this->lang->GetMessage('title-add-property');?></h3>
    
        <form method="post" >
            
            <table border="1" class="gy-table-all-users">

                <tr>
                    <td><?=$this->lang->GetMessage('name');?></td>
                    <td><input type="text" name="name_property" ></td> 
                </tr>
                
                <tr>
                    <td><?=$this->lang->GetMessage('type');?></td>
                    <td>
                        <select name="type_property">
                            <? foreach ($arRes['allTypePropertys'] as $value) { ?>
                                <option value="<?=$value['id']?>"><?=$value['name_type']?> - <?=$value['info']?></option> 
                            <?}?>  
                        </select>
                    </td>
                </tr>
            
                <tr>
                    <td><?=$this->lang->GetMessage('code');?></td>
                    <td><input type="text"  name="code" ></td>
                </tr>
            </table>
            <input type="submit" class="gy-admin-button" value="<?=$this->lang->GetMessage('add-property');?>" />
        </form>
    <?}?>
<?}?>
        