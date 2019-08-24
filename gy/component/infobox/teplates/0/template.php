<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>

<?if (!empty($arRes['status']) ){?>
    <?if ( $arRes['status'] == 'del-ok'){ ?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('del-ok');?></div>
        <br/>
    <?}?>

    <?if ($arRes['status'] == 'del-err'){?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage('del-err');?></div>
        <br/>
    <?}?>
    <a href="<?=$_SERVER['REQUEST_URI']?>" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<?}else{?>
        
    <?if ($arRes['ITEMS']){?>
        <table border="1" class="gy-table-all-users">
            <tr><th>id</th><th>name</th><th>code</th><th></th><th></th><th></th></tr>
            <? foreach ($arRes['ITEMS'] as $key => $val){?>
                <tr>
                    <td><?=$val['id']?></td>
                    <td><?=$val['name']?></td>
                    <td><?=$val['code']?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="ID" value="<?=$val['id']?>" />
                            <input type="submit" class="gy-admin-button" name="<?=$this->lang->GetMessage('del');?>" value="<?=$this->lang->GetMessage('del');?>" />
                        </form>
                    </td>
                    <td><a href="/gy/admin/info-box-edit.php?ID=<?=$val['id']?>" class="gy-admin-button"><?=$this->lang->GetMessage('edit');?></a></td>
                    <td><a href="/gy/admin/info-box-element-list.php?info-box-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('show-element');?></a></td>
                </tr>
            <?}?>
        </table>

    <?}else{?>
        <?=$this->lang->GetMessage('not-element');?>
        <br/>
        <br/>
        <br/>
    <?}?>

    <a href="/gy/admin/info-box-add.php" class="gy-admin-button"><?=$this->lang->GetMessage('add');?></a>
<?}?>