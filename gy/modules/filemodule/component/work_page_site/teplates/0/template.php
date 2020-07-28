<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->GetMessage('title-edit-file');?></h1>

<?if(empty($arRes['status'])){?>
    <form method="post">
        <h4><?=$this->lang->GetMessage('text-input-url-page');?></h4>
        <span>/</span><input type="text" name="url-site-page" /><span>/index.php</span>
        <br/>
        <input class="gy-admin-button" type="submit" name="action-1" value="<?=$this->lang->GetMessage('title-add-page');?>" />
        <input class="gy-admin-button" type="submit" name="action-2" value="<?=$this->lang->GetMessage('title-edit-page');?>" />
        <input class="gy-admin-button" type="submit" name="action-3" value="<?=$this->lang->GetMessage('title-delete-page');?>" />
        <br/>
        <br/>
        <input class="gy-admin-button" type="submit" name="action-4" value="<?=$this->lang->GetMessage('title-action-4-show-page');?>" />
        <input class="gy-admin-button" type="submit" name="action-5" value="<?=$this->lang->GetMessage('title-action-5');?>" />
    </form>
<?}else{
    if( ($arRes['status'] != 'edit') && ($arRes['status'] != 'err') && ($arRes['status'] != 'constructor') ){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage($arRes['status']);?></div>
        <br/>
        <a href="/gy/admin/get-admin-page.php?page=work-page-site" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
    <?}elseif($arRes['status'] == 'edit'){ ?>       
        <form method="post">
            <h4><?=$this->lang->GetMessage('text-edit-page');?></h4>
            <input type="hidden" name="url-site-page" value="<?=$arRes['url-site-page']?>" />
            <span><?=$arRes['url-site-page']?>/index.php</span>
            <br/>
            <br/>
            <textarea class="textarea-code" rows="50" cols="120" name="new-text-page"><?=$arRes['data-file']?></textarea>
            <br/>
            <br/>
            <input class="gy-admin-button" type="submit" name="action-2-1" value="<?=$this->lang->GetMessage('text-button-save');?>" />
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
        </form>
    <?}elseif($arRes['status'] == 'err'){ ?>
        <div class="gy-admin-error-message"><?=$this->lang->GetMessage($arRes['status']);?></div>
        <br/>
        <a href="/gy/admin/get-admin-page.php?page=work-page-site" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
    <?}elseif($arRes['status'] == 'constructor'){?>
        
        <h4><?=$this->lang->GetMessage('title-action-5');?></h4>
        <?
        $countIncludeComponentsInPageSite = count($arRes['dataIncludeAllComponentsInThisPageSite']);?>
        
        <p><?=$this->lang->GetMessage('text-include-components');?><?=$countIncludeComponentsInPageSite;?></p>


        <form method="post">
            <input type="hidden" name="url-site-page" value="<?=$arRes['url-site-page']?>" />

            <input <?// TODO?>
                class="gy-admin-button" 
                type="submit" 
                name="action-2-1" 
                value="<?=$this->lang->GetMessage('add-component');?>" 
            />

            <? foreach ($arRes['dataIncludeAllComponentsInThisPageSite'] as $key => $component) { ?>
                <div class="data-component">
                    =============================<?=$this->lang->GetMessage('include-component');?><?=$key?>============================
                    <p><?=$this->lang->GetMessage('text-include-this-component');?><?=$component['name']?></p>
                    <input type="hidden" name="component[<?=$key;?>][component]" value="<?=$component['name']?>">
                    <p>
                        <?=$this->lang->GetMessage('name-template');?>
                        <input type="text" name="component[<?=$key;?>][tempalate]" value="<?=$component['template']?>">
                    </p>
                    <p>
                        <?=$this->lang->GetMessage('params-component');?>
                    </p>
                    <table border="1" class="gy-table-all-users">
                        <tr><th><?=$this->lang->GetMessage('param-name');?></th><th><?=$this->lang->GetMessage('param-value');?></th></tr>
                        <? 
                        // TODO компонент includeHtml в параметре html с кавычками и всё ламается
                        //    пока заменил input на textarea надо протестить

                        foreach ($component['arParam'] as $keyParam => $valueParam) { ?>
                            <tr>
                                <td><?=$keyParam?></td>
                                <td>
                                    <textarea type="text" name="component[<?=$key;?>][params][<?=$keyParam?>]" ><?=$valueParam?></textarea>
                                </td>
                            </tr>   
                        <?}?>
                    </table>    

                    <input 
                        class="gy-admin-button" 
                        type="submit" 
                        name="action7_3[<?=$key;?>]" 
                        value="<?=$this->lang->GetMessage('text-button-del-component');?>" 
                    />
                    <br/>
                    <input 
                        class="gy-admin-button" 
                        type="submit" 
                        name="action7_1[<?=$key;?>]" 
                        value="<?=$this->lang->GetMessage('text-button-up-component');?>" 
                    />
                    <input
                        class="gy-admin-button" 
                        type="submit" 
                        name="action7_2[<?=$key;?>]" 
                        value="<?=$this->lang->GetMessage('text-button-down-component');?>" 
                    />
                    <br/>
                    <input <?// TODO?>
                        class="gy-admin-button" 
                        type="submit" 
                        name="action-2-1" 
                        value="<?=$this->lang->GetMessage('add-component');?>" 
                    />
                    <br/>
                    ==========================================================================
                </div>
            <?}?>

            <br/>
            <br/>
            <input class="gy-admin-button" type="submit" name="action-6" value="<?=$this->lang->GetMessage('text-button-save2');?>" />
            <br/>
            *<?=$this->lang->GetMessage('warning-text-1');?>
            <br/>
            <br/>
            <br/>
            <br/>

        </form>
                
    <?}
}
