<?php 
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

if ( !empty($arRes["allUsersGroups"]) && !empty($arRes["allActionUser"]) ) {?>

    <?if(empty($arRes['status'])){?>

        <h1><?=$this->lang->GetMessage('title');?></h1>
        <form method="post">
            <table border="1" class="gy-table-all-users">
                <tr><th><?=$this->lang->GetMessage('groups');?></th><th><?=$this->lang->GetMessage('actions');?></th></tr>
                <? foreach ($arRes['allUsersGroups'] as $val){?>
                    <tr>
                        <td><?=$val['name']?>(<?=$val['code']?>)</td>
                        <td>
                            <select multiple="" name="groupsActions[<?=$val['code']?>][]">
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
                    </tr>
                <?}?>
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

<?}?>