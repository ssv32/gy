<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->GetMessage('title-edit-file');?></h1>

<?if(empty($arRes['status'])){?>
    <form method="post">
        <h4><?=$this->lang->GetMessage('text-input-url-page');?></h4>
        <span>/</span><input type="text" name="url-site-page" /><span>/index.php</span>
        <br/>
        <input type="submit" name="action-1" value="Создать страницу (заменит если уже есть)" />
        <input type="submit" name="action-2" value="Изменить страницу" />
        <input type="submit" name="action-3" value="Удалить страницу" />
    </form>
<?}else{
    if( ($arRes['status'] != 'edit') && ($arRes['status'] != 'err') ){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage($arRes['status']);?></div>
        <br/>
        <a href="/gy/admin/get-admin-page.php?page=work-page-site" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
    <?}elseif($arRes['status'] == 'edit'){ ?>       
        <form method="post">
            <h4><?=$this->lang->GetMessage('text-edit-page');?></h4>
            <input type="hidden" name="url-site-page" value="<?=$arRes['url-site-page']?>" />
            <span><?=$arRes['url-site-page']?>/index.php</span>
            <br/>
            <textarea rows="50" cols="120" name="new-text-page"><?=$arRes['data-file']?></textarea>
            <br/>
            <br/>
            <input type="submit" name="action-2-1" value="Сохранить" />
        </form>
    <?}elseif($arRes['status'] == 'err'){ ?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage($arRes['status']);?></div>
        <br/>
        <a href="/gy/admin/get-admin-page.php?page=work-page-site" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
    <?}?>
    
    <?
}
