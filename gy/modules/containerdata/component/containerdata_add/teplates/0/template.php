<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

if ($arRes['status'] == 'add') { ?>
    <h1><?=$this->lang->getMessage('title');?></h1>
    <form method="post">
        <table border="1" class="gy-table-all-users">
            <?php foreach ($arRes['property'] as $val) {?>
                <tr>
                    <td><?=$val?></td>
                    <td><input type="text" name="<?=$val?>" value="" /></td>
                </tr>
            <?php }?>
        </table>     
        <input type="submit" class="gy-admin-button" value="<?=$this->lang->getMessage('save');?>" />
    </form>    
    <br/>
    <a href="" class="gy-admin-button"><?=$this->lang->getMessage('back');?></a>
<?php }?>    
    
<?php if ($arRes['status'] == 'add-ok'){?>
    <div class="gy-admin-good-message"><?=$this->lang->getMessage('add-ok');?></div>
    <br/>
    <a href="/gy/admin/get-admin-page.php?page=container-data" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php } ?>
    
<?php if ($arRes['status'] == 'add-err') {?>
    <div class="gy-admin-error-message"><?=$this->lang->getMessage('add-err');?></div>
    <br/>
    <a href="/gy/admin/get-admin-page.php?page=container-data" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php } 