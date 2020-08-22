<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->GetMessage('title');?></h1>

<?if (!empty($arRes['del-stat']) ){?>
    <?if ( $arRes['del-stat'] == 'ok'){ ?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('del-ok');?></div>
        <br/>
    <?}?>

    <?if ($arRes['del-stat'] == 'err'){?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage('del-err');?></div>
        <br/>
    <?}?>
    <a href="users.php" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<?}else{?>

    <?if ($arRes['allUsers']){?>
        <table border="1" class="gy-table-all-users">
            <tr><th>id</th><th>login</th><th>name</th><th>group</th><th></th></tr>

                <?foreach ($arRes['allUsers'] as $key => $val){?>
                    <tr>
                        <td><?=$val['id'];?></td>
                        <td><?=$val['login'];?></td>
                        <td><?=$val['name'];?></td>
                        <td>
                            <? foreach ($val['groups'] as $groupIs) {?>
                                -
                                <?=$arRes['allUsersGroups'][$groupIs]['name'];?>
                                (
                                <?=$arRes['allUsersGroups'][$groupIs]['code'];?>
                                );
                                <br/>
                            <?}?>

                        </td>
                        <td>
                            <?if ($val['id'] != 1){?>
                                <br/>
                                <a href="users.php?del-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('del-user');?></a>
                                <a href="edit-user.php?edit-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('edit-user');?></a>
                                <a href="?show-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('show-user');?></a> <?// TODO ?>
                                <br/>
                                <br/>
                            <?} ?>
                        </td>
                    </tr>
                <?}?>

        </table>

        <br/>
        <br/>
        <a class="gy-admin-button" href="add-user.php"><?=$this->lang->GetMessage('add-user');?></a>
        <br/>
        <br/>
        <br>
        <br>
        <a href="group-user.php" class="gy-admin-button"><?=$this->lang->GetMessage('options-groups');?></a> 
        <br/>
        <br/>
        <br/>
        <br/>
        <a href="edit-all-users-propertys.php" class="gy-admin-button"><?=$this->lang->GetMessage('list-all-user-propertys');?></a>
    <?}?>
<?}?>
        