<?php if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->getMessage('title');?></h1>

<?php if (!empty($arRes['del-stat'])) {?>
    <?php if ($arRes['del-stat'] == 'ok') { ?>
        <div class="gy-admin-good-message"><?=$this->lang->getMessage('del-ok');?></div>
        <br/>
    <?php }?>

    <?php if ($arRes['del-stat'] == 'err') {?>
        <div class="gy-admin-error-message"><?=$this->lang->getMessage('del-err');?></div>
        <br/>
    <?php }?>
    <a href="users.php" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php } else {?>

    <?php if ($arRes['allUsers']) {?>
        <table border="1" class="gy-table-all-users">
            <tr><th>id</th><th>login</th><th>name</th><th>group</th><th></th></tr>

                <?php foreach ($arRes['allUsers'] as $key => $val) {?>
                    <tr>
                        <td><?=$val['id'];?></td>
                        <td><?=$val['login'];?></td>
                        <td><?=$val['name'];?></td>
                        <td>
                            <?php foreach ($val['groups'] as $groupIs) {?>
                                -
                                <?=$arRes['allUsersGroups'][$groupIs]['name'];?>
                                (
                                <?=$arRes['allUsersGroups'][$groupIs]['code'];?>
                                );
                                <br/>
                            <?php }?>

                        </td>
                        <td>
                            <?php if ($val['id'] != 1) {?>
                                <br/>
                                <a href="users.php?del-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->getMessage('del-user');?></a>
                                <a href="edit-user.php?edit-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->getMessage('edit-user');?></a>
                                <a href="?show-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->getMessage('show-user');?></a> <?// TODO ?>
                                <br/>
                                <br/>
                            <?php } ?>
                        </td>
                    </tr>
                <?php }?>

        </table>

        <br/>
        <br/>
        <a class="gy-admin-button" href="add-user.php"><?=$this->lang->getMessage('add-user');?></a>
        <br/>
        <br/>
        <br>
        <br>
        <a href="group-user.php" class="gy-admin-button"><?=$this->lang->getMessage('options-groups');?></a> 
        <br/>
        <br/>
        <br/>
        <br/>
        <a href="edit-all-users-propertys.php" class="gy-admin-button"><?=$this->lang->getMessage('list-all-user-propertys');?></a>
    <?php }?>
<?php }?>
        