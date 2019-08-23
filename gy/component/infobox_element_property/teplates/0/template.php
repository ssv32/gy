<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );


if(!empty($arRes['PROPERTY'])){ ?>
    <h1><?=$this->lang->GetMessage('title');?></h1>
    
    <?if( !empty($arRes['stat-save'] ) && ($arRes['stat-save'] == 'ok')){?>
        <div class="gy-admin-good-message"><?=$this->lang->GetMessage('save-ok');?></div>
    <?}?>
    
    <form method="post">
        
        <table border="1" class="gy-table-all-users">
            <tr>
                <th><?=$this->lang->GetMessage('name');?></th>
                <th><?=$this->lang->GetMessage('code');?></th>
                <th><?=$this->lang->GetMessage('type');?></th>
                <th><?=$this->lang->GetMessage('value');?></th>
            </tr>
            <? foreach ($arRes['PROPERTY'] as $val){?>
                <tr>
                    <td><?=$val['name']?></td>
                    <td><?=$val['code']?></td>
                    <td><?=$arRes['PROPERTY_TYPE'][$val['id_type_property']]['name']?></td>
                    <td>
                        <input 
                            type="text" 
                            <?if(!empty($arRes['PROPERTY_VALUE'][$val['id']])){?>
                                name="propertyUpdate[<?=$arRes['PROPERTY_VALUE'][$val['id']]['id']?>]" 
                            <?}else{?>
                                name="propertyAdd[<?=$val['id']?>]" 
                            <?}?>    
                            value="<?=((!empty($arRes['PROPERTY_VALUE'][$val['id']]))? $arRes['PROPERTY_VALUE'][$val['id']]['value'] : '')?>" 
                        />
                    </td>
                </tr>
            <?}?>
        </table> 
        
        <input type="submit" class="gy-admin-button" value="<?=$this->lang->GetMessage('save');?>" />
    </form>    
   
    <a href="" class="gy-admin-button"><?=$this->lang->GetMessage('back');?></a>
    <br/>
    <br/>
    <br/>
        
<?}
