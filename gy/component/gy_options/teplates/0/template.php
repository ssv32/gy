<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->GetMessage('title');?></h1>

<?if(empty($arRes['status']) && !empty($arRes['button'])){?>
    <? foreach ($arRes['button'] as $val) { ?>
        <form method="post">
            <input type='submit' class="gy-admin-button" name="cacheClear" value="<?=$this->lang->GetMessage('cacheClear');?>" />
        </form>
    <?}?>
<? }else{ ?>
    <?if ($arRes['status'] == 'cacheClear-ok'){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('cacheClear-ok');?></div>
    <? } ?>
    <br/>
    <a href="/gy/admin/options.php" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<?}