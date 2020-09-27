<?php if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->getMessage('title');?></h1>

<?php
if(empty($arRes['stat-save'] )){

    if(!empty($arRes['PROPERTY'])){ ?>

        <form method="post">

            <table border="1" class="gy-table-all-users">
                <tr>
                    <th><?=$this->lang->getMessage('name');?></th>
                    <th><?=$this->lang->getMessage('code');?></th>
                    <th><?=$this->lang->getMessage('type');?></th>
                    <th><?=$this->lang->getMessage('value');?></th>
                </tr>
                <?php foreach ($arRes['PROPERTY'] as $val){?>
                    <tr>
                        <td><?=$val['name']?></td>
                        <td><?=$val['code']?></td>
                        <td><?=$arRes['PROPERTY_TYPE'][$val['id_type_property']]['name']?></td>
                        <td>
                            <?php if($arRes['PROPERTY_TYPE'][$val['id_type_property']]['name'] != 'html'){?>
                                <input 
                                    type="text" 
                                    <?php if(!empty($arRes['PROPERTY_VALUE'][$val['id']])){?>
                                        name="propertyUpdate[<?=$arRes['PROPERTY_VALUE'][$val['id']]['id']?>]" 
                                    <?php }else{?>
                                        name="propertyAdd[<?=$val['id']?>]" 
                                    <?php }?>    
                                    value="<?=((!empty($arRes['PROPERTY_VALUE'][$val['id']]))? $arRes['PROPERTY_VALUE'][$val['id']]['value'] : '')?>" 
                                />
                            <?php }else{?>
                                <textarea 
                                    rows="5" cols="70"
                                    <?php if(!empty($arRes['PROPERTY_VALUE'][$val['id']])){?>
                                        name="propertyUpdate[<?=$arRes['PROPERTY_VALUE'][$val['id']]['id']?>]" 
                                    <?php }else{?>
                                        name="propertyAdd[<?=$val['id']?>]" 
                                    <?php }?>    
                                /><?=((!empty($arRes['PROPERTY_VALUE'][$val['id']]))? $arRes['PROPERTY_VALUE'][$val['id']]['value'] : '')?></textarea>
                            <?php }?>
                        </td>
                    </tr>
                <?php }?>
            </table> 

            <input type="submit" class="gy-admin-button" value="<?=$this->lang->getMessage('save');?>" />
        </form>    
        
        <br/>
        <a href="" class="gy-admin-button"><?=$this->lang->getMessage('back');?></a>
        <br/>
        <br/>
        <br/>

    <?php }else{?>
        <?=$this->lang->getMessage('PROPERTY_NULL');?>
    <?php }?>
<?php }else{?>
    <?php if( !empty($arRes['stat-save'] ) && ($arRes['stat-save'] == 'ok')){?>
        <div class="gy-admin-good-message"><?=$this->lang->getMessage('save-ok');?></div>
    <?php }?>
    <a href="<?=$_SERVER['REQUEST_URI']?>" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php }
        