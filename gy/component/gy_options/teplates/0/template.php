<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->GetMessage('title');?></h1>

<?if(empty($arRes['status']) && !empty($arRes['button'])){?>
    <? foreach ($arRes['button'] as $val) { ?>
        <form method="post">
            <?if(!empty($arRes['langs'])){?>
                <br/>
                ================================
                <br/>
                <?=$this->lang->GetMessage('title-lang');?>:
                <select name="lang">
                    <? foreach ($arRes['langs'] as $value) { ?>
                        <option 
                            value="<?=$value?>"
                            <?if ($value == $arRes['this-lang']){?>
                                selected
                            <?}?>
                        >
                            <?=$value?>
                        </option>
                    <?}?>
                </select>
                <br/>
                <input type='submit' class="gy-admin-button" name="save" value="<?=$this->lang->GetMessage('save');?>" />
                <br/>
                ===============================
                <br/>
            <?}?>
            
            <input type='submit' class="gy-admin-button" name="cacheClear" value="<?=$this->lang->GetMessage('cacheClear');?>" />
        </form>
    <?}?>
<? }else{ ?>
    <?if ($arRes['status'] == 'cacheClear-ok'){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('cacheClear-ok');?></div>
    <?}elseif($arRes['status'] == 'save-ok'){ ?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('save-ok');?></div>
    <?}elseif($arRes['status'] == 'save-err'){ ?>
        <div class="gy-admin-error-message">
            <?=$this->lang->GetMessage('save-err');?>:
            <br/>
            <?=$arRes['status-text'];?>
        </div>
    <?}?>

    <br/>
    <a href="/gy/admin/options.php" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<?}