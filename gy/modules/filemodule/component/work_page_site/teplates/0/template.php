<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->getMessage('title-edit-file');?></h1>

<?php if(empty($arRes['status'])){?>
    <form method="post">
        <h4><?=$this->lang->getMessage('text-input-url-page');?></h4>
        <div class="button-function">
            <span>/</span><input class="input-text" type="text" name="url-site-page" /><span>/index.php</span>
            <?php // TODO сделать выбор из имеющихся?>
            <br/>
            <input class="gy-admin-button" type="submit" name="action-1" value="<?=$this->lang->getMessage('title-add-page');?>" />
            <br/>
            <input class="gy-admin-button" type="submit" name="action-2" value="<?=$this->lang->getMessage('title-edit-page');?>" />
            <br/>
            <input class="gy-admin-button" type="submit" name="action-3" value="<?=$this->lang->getMessage('title-delete-page');?>" />
            <br/>
            <br/>
            <input class="gy-admin-button" type="submit" name="action-4" value="<?=$this->lang->getMessage('title-action-4-show-page');?>" />
            <br/>
            <input class="gy-admin-button" type="submit" name="action-5" value="<?=$this->lang->getMessage('title-action-5');?>" />
            <br/>
        </div>
    </form>
<?php }else{
    if( ($arRes['status'] != 'edit') 
        && ($arRes['status'] != 'err') 
        && ($arRes['status'] != 'constructor') 
        && ($arRes['status'] != 'addConstructor') 
        && ($arRes['status'] != 'error-not-component')          
        && ($arRes['status'] != 'good-component')          
    ){?>
        <div class="gy-admin-good-message"><?=$this->lang->getMessage($arRes['status']);?></div>
        <br/>
        <a href="/gy/admin/get-admin-page.php?page=work-page-site" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
    <?php }elseif($arRes['status'] == 'edit'){ ?>       
        <form method="post">
            <h4><?=$this->lang->getMessage('text-edit-page');?></h4>
            <input type="hidden" name="url-site-page" value="<?=$arRes['url-site-page']?>" />
            <span><?=$arRes['url-site-page']?>/index.php</span>
            <br/>
            <br/>
            <textarea class="textarea-code" rows="50" cols="120" name="new-text-page"><?=$arRes['data-file']?></textarea>
            <br/>
            <br/>
            <input class="gy-admin-button" type="submit" name="action-2-1" value="<?=$this->lang->getMessage('text-button-save');?>" />
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
        </form>
    <?php }elseif($arRes['status'] == 'err'){ ?>
        <div class="gy-admin-error-message"><?=$this->lang->getMessage($arRes['status']);?></div>
        <br/>
        <a href="/gy/admin/get-admin-page.php?page=work-page-site" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
    <?php }elseif($arRes['status'] == 'constructor'){?>        
        <h4><?=$this->lang->getMessage('title-action-5');?></h4>
        <?php
        $countIncludeComponentsInPageSite = count($arRes['dataIncludeAllComponentsInThisPageSite']);?>
        
        <p><?=$this->lang->getMessage('text-include-components');?><?=$countIncludeComponentsInPageSite;?></p>

        <form method="post">
            <input type="hidden" name="url-site-page" value="<?=$arRes['url-site-page']?>" />

            <input 
                class="gy-admin-button" 
                type="submit" 
                name="action_8['-1']" 
                value="<?=$this->lang->getMessage('add-component');?>" 
            />
            <?php foreach ($arRes['dataIncludeAllComponentsInThisPageSite'] as $key => $component) { ?>
                <div class="data-component">
                    <div class="title-n-component"><?=$this->lang->getMessage('include-component');?><?=$key?></div>
                    <p><?=$this->lang->getMessage('text-include-this-component');?><?=$component['name']?></p>
                    <input type="hidden" name="component[<?=$key;?>][component]" value="<?=$component['name']?>">
                    <p>
                        <?=$this->lang->getMessage('name-template');?>
                        <input type="text" name="component[<?=$key;?>][tempalate]" value="<?=$component['template']?>">
                    </p>
                   
                    
                    <?php if(!empty($component['componentInfo']['v'])){?>
                        <p>
                            <?=$this->lang->getMessage('this_v_component');?>: <?=$component['componentInfo']['v']?>   
                        </p>
                    <?php }?>
                        
                    <?php if(!empty($component['componentInfo']['text-info'])){?>
                        <p>
                            <?=$this->lang->getMessage('this_component_text_info');?>: <?=$component['componentInfo']['text-info']?> 
                        </p>
                    <?php }?>    
                        
                    <p>
                        <?=$this->lang->getMessage('params-component');?>
                    </p>
                    <table border="1" class="gy-table-all-users">
                        <tr>
                            <th><?=$this->lang->getMessage('param-name');?></th>
                            <th><?=$this->lang->getMessage('param-value');?></th>
                            <th><?=$this->lang->getMessage('param-info-text');?></th>
                        </tr>
                        <?php 
                        // TODO компонент includeHtml в параметре html с кавычками и всё ламается
                        //    пока заменил input на textarea надо протестить

                        foreach ($component['arParam'] as $keyParam => $valueParam) { ?>
                            <tr>
                                <td><?=$keyParam?></td>
                                <td>
                                    <textarea type="text" name="component[<?=$key;?>][params][<?=$keyParam?>]" ><?=$valueParam?></textarea>
                                </td>
                                <td>
                                    <?php if(!empty($component['componentInfo']['all-property-text'][$keyParam])){?>
                                        <?=$component['componentInfo']['all-property-text'][$keyParam]?>
                                    <?php }?>
                                </td>
                            </tr>   
                        <?php }?>
                    </table>    
                    
                    <div class="button-function">
                        <input 
                            class="gy-admin-button" 
                            type="submit" 
                            name="action7_3[<?=$key;?>]" 
                            value="<?=$this->lang->getMessage('text-button-del-component');?>" 
                        />
                        <br/>
                        <input 
                            class="gy-admin-button" 
                            type="submit" 
                            name="action7_1[<?=$key;?>]" 
                            value="<?=$this->lang->getMessage('text-button-up-component');?>" 
                        />
                        <br/>
                        <input
                            class="gy-admin-button" 
                            type="submit" 
                            name="action7_2[<?=$key;?>]" 
                            value="<?=$this->lang->getMessage('text-button-down-component');?>" 
                        />
                        <br/>
                        <input
                            class="gy-admin-button" 
                            type="submit" 
                            name="action_8[<?=$key;?>]" 
                            value="<?=$this->lang->getMessage('add-component');?>" 
                        />
                    </div>
                    <br/>
                </div>
            <?php }?>

            <input class="gy-admin-button" type="submit" name="action-6" value="<?=$this->lang->getMessage('text-button-save2');?>" />
            <br/>
            <span class="warning">*<?=$this->lang->getMessage('warning-text-1');?></span>
            <br/>
            <br/>
            <br/>
            <br/>

        </form>
                
    <?php }elseif($arRes['status'] == 'addConstructor'){ // если добавление компонента ?>
        <h4><?=$this->lang->getMessage('title-action-8');?></h4>
        <form method="post">
            <input type="hidden" name="url-site-page" value="<?=$arRes['url-site-page']?>" />
            <input type="hidden" name="position_new_component" value="<?=$arRes['key']?>" />
            <p>
                <?=$this->lang->getMessage('name-new-component');?>
                <input type="text" name="name_new_component" value="<?=$component['template']?>">
                <?php // TODO сделать выбор из имеющихся + выводить описаие?>
            </p>
            <p>
                <?=$this->lang->getMessage('name-new-template');?>
                <input type="text" name="name_new_template" value="<?=$component['template']?>">
            </p>
            <input
                class="gy-admin-button" 
                type="submit" 
                name="action_8_1" 
                value="<?=$this->lang->getMessage('next');?>" 
            />
            
        </form>    
    <?php }elseif( $arRes['status'] == 'error-not-component'){ // ошибка при добавление компонента (не найден компонент)?>
        <div class="gy-admin-error-message"><?=$this->lang->getMessage('not-component');?></div>
        <br/>
        <a href="/gy/admin/get-admin-page.php?page=work-page-site" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
    <?php }elseif($arRes['status'] == 'good-component'){ // последний шаг добавления компонента, ввод параметров компонента ?>   
        <h4><?=$this->lang->getMessage('title-action-8');?></h4>
        <form method="post">
            <input type="hidden" name="url-site-page" value="<?=$arRes['url-site-page']?>" />
            <input type="hidden" name="position_new_component" value="<?=$arRes['position_new_component']?>" />
            <p>
                <?=$this->lang->getMessage('this_component');?>: <?=$arRes['data-component']['name']?>
                <input type="hidden" name="name_new_component" value="<?=$arRes['data-component']['name']?>">
            </p>
            
            <?php if (!empty($arRes['data-component']['componentInfo']['v'])){?>
                <p>
                    <?=$this->lang->getMessage('this_v_component');?>: <?=$arRes['data-component']['componentInfo']['v']?>
                </p>
            <?php }?>
                
            <?php if(!empty($arRes['data-component']['componentInfo']['text-info'])){?>
                <p>
                    <?=$this->lang->getMessage('this_component_text_info');?>: <?=$arRes['data-component']['componentInfo']['text-info']?> 
                </p>
            <?php }?>   
            
            <p>
                <?=$this->lang->getMessage('this_template_component');?>: <?=$arRes['data-component']['template']?>
                <input type="hidden" name="name_new_template" value="<?=$arRes['data-component']['template']?>">
            </p>
           
            <table border="1" class="gy-table-all-users">
                <tr>
                    <th><?=$this->lang->getMessage('param-name');?></th>
                    <th><?=$this->lang->getMessage('param-value');?></th>
                    <th><?=$this->lang->getMessage('param-info-text');?></th>
                </tr>
                <?php
                foreach ($arRes['data-component']['arParam'] as $keyParam => $valueParam) { ?>
                    <tr>
                        <td><?=$valueParam?></td>
                        <td>
                            <textarea type="text" name="params[<?=$valueParam?>]" ></textarea>
                        </td>
                        <td>
                            <?php if(!empty($arRes['data-component']['componentInfo']['all-property-text'][$valueParam])){?>
                                <?=$arRes['data-component']['componentInfo']['all-property-text'][$valueParam]?>
                            <?php }?>
                        </td>
                    </tr>   
                <?php }?>
            </table>  
            
            <input
                class="gy-admin-button" 
                type="submit" 
                name="action_8_2" 
                value="<?=$this->lang->getMessage('next_final');?>" 
            />
            
        </form> 
        
    <?php }    
}
