<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->getMessage('title-container-data');?></h1>

<?php if (!empty($arRes['status'])) {?>
    <?php if ( $arRes['status'] == 'del-ok'){ ?>
        <div class="gy-admin-good-message"><?=$this->lang->getMessage('del-ok');?></div>
        <br/>
    <?php }?>

    <?php if ($arRes['status'] == 'del-err') {?>
        <div class="gy-admin-error-message"><?=$this->lang->getMessage('del-err');?></div>
        <br/>
    <?php }?>
    <a href="<?=$_SERVER['REQUEST_URI']?>" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php } else {?>
        
    <?php if ($arRes['ITEMS']) {?>
        <table border="1" class="gy-table-all-users">
            <tr><th>id</th><th>name</th><th>code</th><th></th><th></th><th></th></tr>
            <?php foreach ($arRes['ITEMS'] as $key => $val) {?>
                <tr>
                    <td><?=$val['id']?></td>
                    <td><?=$val['name']?></td>
                    <td><?=$val['code']?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="ID" value="<?=$val['id']?>" />
                            <input type="submit" class="gy-admin-button" name="<?=$this->lang->getMessage('del');?>" value="<?=$this->lang->getMessage('del');?>" />
                        </form>
                    </td>
                    <td><a href="/gy/admin/get-admin-page.php?page=container-data-edit&ID=<?=$val['id']?>" class="gy-admin-button"><?=$this->lang->getMessage('edit');?></a></td>
                    <td><a href="/gy/admin/get-admin-page.php?page=container-data-element-list&container-data-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->getMessage('show-element');?></a></td>
                </tr>
            <?php }?>
        </table>

    <?php } else {?>
        <?=$this->lang->getMessage('not-element');?>
        <br/>
        <br/>
        <br/>
    <?php }?>
    <br/>
    <br/>
    <a href="/gy/admin/get-admin-page.php?page=container-data-add" class="gy-admin-button"><?=$this->lang->getMessage('add');?></a>
<?php }