<?php 
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

if ( !empty($arRes["allUsersGroups"]) && !empty($arRes["allActionUser"]) ) {?>

    <?if(empty($arRes['status'])){?>

        <h1><?=$this->lang->GetMessage('title');?></h1>
        <form method="post">
            <table border="1" class="gy-table-all-users">
                <tr>
                    <th><?=$this->lang->GetMessage('groups');?></th>
                    <th><?=$this->lang->GetMessage('text');?></th>
                    <th><?=$this->lang->GetMessage('actions');?></th>
                    <th></th>
                </tr>
                <? foreach ($arRes['allUsersGroups'] as $val){?>
                    <tr>
                        
                        <td><?=$val['name']?>(<?=$val['code']?>)</td>
                        <td><?=$val['text']?></td>
                        <td>
                            <select <?=(($val['code'] == 'admins')? 'disabled': '');?> multiple="" name="groupsActions[<?=$val['code']?>][]">
                                <? foreach ($arRes['allActionUser'] as $userActions) {?>
                                    <option 
                                        value="<?=$userActions['code']?>" 
                                        <?=((!empty($val['code_action_user'][$userActions['code']]))? 'selected' : '')?> 
                                    >
                                        <?=$userActions['text']?>(<?=$userActions['code']?>)
                                    </option>
                                <?}?>
                            </select>
                        </td>
                        <td> 
                            <?if(!empty($val['flag_del']) && ($val['flag_del'] == 'Y')){?> 
                                <input type="checkbox" name="delete[<?=$val['code']?>]" /><?=$this->lang->GetMessage('delete');?> 
                            <?}?>
                        </td>
                    </tr>
                <?}?>
                <tr>
                    <td colspan="4"><b><?=$this->lang->GetMessage('title-add-group');?></b></td>
                </tr>
                <tr>
                    <td>
                        Название:<input type="text" name="add-group-name" />
                        <br/>
                        (код:<input type="text" name="add-group-code" />)
                    </td>
                    <td>описание:<input type="text" name="add-group-text" /></td>
                    <td>
                        <select multiple="" name="groupsActions[add-group-action-user][]">
                            <? foreach ($arRes['allActionUser'] as $userActions) {?>
                                <option value="<?=$userActions['code']?>" >
                                    <?=$userActions['text']?>(<?=$userActions['code']?>)
                                </option>
                            <?}?>
                        </select>
                    </td>
                    <td></td>
                    
                </tr>
            </table> 

            <input type="submit" name="button-form" class="gy-admin-button" value="<?=$this->lang->GetMessage('save');?>" />
        </form>    
        <br/>
        <a href="" class="gy-admin-button"><?=$this->lang->GetMessage('back');?></a>
        <br/>
        <br/>
        <br/>
    <?}?>
   
    <?if(!empty($arRes['status'])){?>    
        <?if ($arRes['status'] == 'ok'){?>
            <div class="gy-admin-good-message"><?=$this->lang->GetMessage('text-ok');?></div>
            <br/>
            <a href="/gy/admin/group-user.php" class="gy-admin-button"><?=$this->lang->GetMessage('button-text-ok');?></a>
        <? } ?>

        <?if ($arRes['status'] == 'add-err'){?>
            <div class="gy-admin-error-message"><?=$this->lang->GetMessage('text-err');?></div>
            <br/>
            <a href="/gy/admin/group-user.php" class="gy-admin-button"><?=$this->lang->GetMessage('button-text-ok');?></a>
        <? } ?>
    <?}?>

<?}