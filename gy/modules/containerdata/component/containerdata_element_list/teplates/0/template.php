<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );?>

<h4><?=$this->lang->getMessage('title');?></H4>

<?php
$isEdit = (!empty($arRes['stat-del']) && ($arRes['stat-del'] == 'edit'));

if ((empty($arRes['stat']) && empty($arRes['stat-edit']) && empty($arRes['stat-del'])) || $isEdit ) {?>
    
    <?php
    if (!empty($arRes['ITEMS'])){ ?>
        <table border="1" class="gy-table-all-users">
            <tr><th>code</th><th>name</th><th>section id</th><th></th><th></th><th></th></tr>

            <?php foreach ($arRes['ITEMS'] as $val) {?>
                <tr>
                    <td><?=$val['code']?></td>
                    <td><?=$val['name']?></td>
                    <td><?=$val['section_id']?></td>
                    <td><a href="?page=container-data-element-list&container-data-id=<?=$arParam['container-data-id']?>&el-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->getMessage('el-edit');?></a></td>
                    <td><a href="/gy/admin/get-admin-page.php?page=container-data-element-property&container-data-id=<?=$arParam['container-data-id']?>&el-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->getMessage('el-view-property');?></a></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="id" value="<?=$val['id']?>" />
                            <input type="submit" class="gy-admin-button" name="del-el" value="<?=$this->lang->getMessage('el-del');?>" />
                        </form>
                    </td>
                </tr>
            <?php }?>
        </table> 
    <?php } else {?>
        <?=$this->lang->getMessage('ITEMS-NULL');?>
    <?php }?>

    <h4><?=$this->lang->getMessage('title-add-element');?></H4>
    
    <form method="post">
        <input name="id_container_data" type="hidden" value="<?=$arParam['container-data-id']?>" />
        <input name="section_id" type="hidden" value="0" /> <?php // TODO пока так (всегда один раздел н можно доработать)?>

        <?php if ($isEdit) {?>
            <input name="el_edit_id" type="hidden" value="<?=$arRes['edit-id']?>" />
        <?php }?>

        <table border="1" class="gy-table-all-users">

            <tr><td>code</td><td><input type="text" name="code" value="<?=(($isEdit)? $arRes['edit-el-data']['code'] : '' )?>" /></td></tr>

            <tr><td>name</td><td><input type="text" name="name" value="<?=(($isEdit)? $arRes['edit-el-data']['name'] : '' )?>" /></td></tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" class="gy-admin-button" value="<?=(($isEdit)? $this->lang->getMessage('save'): $this->lang->getMessage('add'));?>" /> 
                    <a href="" class="gy-admin-button"><?=$this->lang->getMessage('back');?></a>
                </td>
            </tr>
        </table> 

    </form>
<?php } else {?>
    <?php if (!empty($arRes['stat-del'])) { ?>
        <?php if ($arRes['stat-del'] == 'ok') {?>
            <div class="gy-admin-good-message"><?=$this->lang->getMessage('del-ok');?></div>
        <?php } elseif ($arRes['stat-del'] == 'err') {?>
            <div class="gy-admin-error-message"><?=$this->lang->getMessage('add-err');?></div>
        <?php }?>
    <?php }?>
    
    <?php if (!empty($arRes['stat'])) { ?>
        <?php if ($arRes['stat'] == 'ok') {?>
            <div class="gy-admin-good-message"><?=$this->lang->getMessage('add-ok');?></div>
        <?php } elseif ($arRes['stat'] == 'err') {?>
            <div class="gy-admin-error-message"><?=$this->lang->getMessage('add-err');?></div>
        <?php }?>
    <?php }?>

    <?php if (!empty($arRes['stat-edit'])) { ?>
        <?php if ($arRes['stat-edit'] == 'ok') {?>
            <div class="gy-admin-good-message"><?=$this->lang->getMessage('edit-ok');?></div>
        <?php } elseif ($arRes['stat-edit'] == 'err') {?>
            <div class="gy-admin-error-message"><?=$this->lang->getMessage('add-err');?></div>
        <?php }?>
    <?php }?>
    
    <a href="<?=$_SERVER['SCRIPT_NAME']?>?page=container-data-element-list&container-data-id=<?=$arParam['container-data-id']?>" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php }  
