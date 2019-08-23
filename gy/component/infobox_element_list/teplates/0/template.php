<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );


    //$this->lang->GetMessage('add-property');?>

<h4><?=$this->lang->GetMessage('title');?></H4>

<?if (!empty($arRes['stat-del'])){ ?>
    <?if($arRes['stat-del'] == 'ok'){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('del-ok');?></div>
    <?}elseif($arRes['stat-del'] == 'err'){?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage('add-err');?></div>
    <?}?>
<?}?>

<?
if(!empty($arRes['ITEMS'])){ ?>
    <table border="1" class="gy-table-all-users">
        <tr><th>code</th><th>name</th><th>section id</th><th></th><th></th><th></th></tr>
        
        <?foreach ($arRes['ITEMS'] as $val){?>
            <tr>
                <td><?=$val['name']?></td>
                <td><?=$val['code']?></td>
                <td><?=$val['section_id']?></td>
                <td><a href="?info-box-id=<?=$arParam['info-box-id']?>&el-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('el-edit');?></a></td>
                <td><a href="/gy/admin/info-box-element-property.php?info-box-id=<?=$arParam['info-box-id']?>&el-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('el-view-property');?></a></td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?=$val['id']?>" />
                        <input type="submit" class="gy-admin-button" name="del-el" value="<?=$this->lang->GetMessage('el-del');?>" />
                    </form>
                </td>
            </tr>
        <?}?>
    </table> 
<?}else{?>
    <?=$this->lang->GetMessage('ITEMS-NULL');?>
<?}?>

<h4><?=$this->lang->GetMessage('title-add-element');?></H4>

<?if (!empty($arRes['stat'])){ ?>
    <?if($arRes['stat'] == 'ok'){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('add-ok');?></div>
    <?}elseif($arRes['stat'] == 'err'){?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage('add-err');?></div>
    <?}?>
<?}?>

<?if (!empty($arRes['stat-edit'])){ ?>
    <?if($arRes['stat-edit'] == 'ok'){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('edit-ok');?></div>
    <?}elseif($arRes['stat-edit'] == 'err'){?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage('add-err');?></div>
    <?}?>
<?}?>
        
<?$isEdit = (!empty($arRes['stat-del']) && ($arRes['stat-del'] == 'edit')); ?>    
        
<form method="post">
    <input name="id_info_box" type="hidden" value="<?=$arParam['info-box-id']?>" />
    <input name="section_id" type="hidden" value="0" /> <?// TODO пока так (всегда один аздел н оможно доработать)?>
    
    <?if($isEdit ){?>
        <input name="el_edit_id" type="hidden" value="<?=$arRes['edit-id']?>" />
    <?}?>
    
    <table border="1" class="gy-table-all-users">
       
        <tr><td>code</td><td><input type="text" name="code" value="<?=(($isEdit)? $arRes['edit-el-data']['code'] : '' )?>" /></td></tr>
            
        <tr><td>name</td><td><input type="text" name="name" value="<?=(($isEdit)? $arRes['edit-el-data']['name'] : '' )?>" /></td></tr>
        
        <tr>
            <td></td>
            <td>
                <input type="submit" class="gy-admin-button" value="<?=(($isEdit)? $this->lang->GetMessage('save'): $this->lang->GetMessage('add'));?>" /> 
                <a href="" class="gy-admin-button"><?=$this->lang->GetMessage('back');?></a>
            </td>
        </tr>
    </table> 
        
    
</form>
