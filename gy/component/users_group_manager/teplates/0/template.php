<?php 
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );

if (!empty($arRes["allUsersGroups"]) && !empty($arRes["allActionUser"])) {?>

    <?php if (empty($arRes['status'])) {?>

        <h1><?=$this->lang->getMessage('title');?></h1>
        <form method="post">
            <table border="1" class="gy-table-all-users">
                <tr>
                    <th><?=$this->lang->getMessage('groups');?></th>
                    <th><?=$this->lang->getMessage('text');?></th>
                    <th><?=$this->lang->getMessage('actions');?></th>
                    <th></th>
                </tr>
                <?php foreach ($arRes['allUsersGroups'] as $val) {?>
                    <tr>
                        
                        <td><?=$val['name']?>(<?=$val['code']?>)</td>
                        <td><?=$val['text']?></td>
                        <td>
                            <select <?=(($val['code'] == 'admins')? 'disabled': '');?> multiple="" name="groupsActions[<?=$val['code']?>][]">
                                <?php foreach ($arRes['allActionUser'] as $userActions) {?>
                                    <option 
                                        value="<?=$userActions['code']?>" 
                                        <?=((!empty($val['code_action_user'][$userActions['code']]))? 'selected' : '')?> 
                                    >
                                        <?=$userActions['text']?>(<?=$userActions['code']?>)
                                    </option>
                                <?php }?>
                            </select>
                        </td>
                        <td> 
                            <?php if (!empty($val['flag_del']) && ($val['flag_del'] == 'Y')) {?> 
                                <input type="checkbox" name="delete[<?=$val['code']?>]" /><?=$this->lang->getMessage('delete');?> 
                            <?php }?>
                        </td>
                    </tr>
                <?php }?>
                <tr>
                    <td colspan="4"><b><?=$this->lang->getMessage('title-add-group');?></b></td>
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
                            <?php foreach ($arRes['allActionUser'] as $userActions) {?>
                                <option value="<?=$userActions['code']?>" >
                                    <?=$userActions['text']?>(<?=$userActions['code']?>)
                                </option>
                            <?php }?>
                        </select>
                    </td>
                    <td></td>
                    
                </tr>
            </table> 

            <input type="submit" name="button-form" class="gy-admin-button" value="<?=$this->lang->getMessage('save');?>" />
        </form>    
        <br/>
        <a href="" class="gy-admin-button"><?=$this->lang->getMessage('back');?></a>
        <br/>
        <br/>
        <br/>
    <?php }?>
   
    <?php if (!empty($arRes['status'])) {?>    
        <?php if ($arRes['status'] == 'ok') {?>
            <div class="gy-admin-good-message"><?=$this->lang->getMessage('text-ok');?></div>
            <br/>
            <a href="/gy/admin/group-user.php" class="gy-admin-button"><?=$this->lang->getMessage('button-text-ok');?></a>
        <?php } ?>

        <?php if ($arRes['status'] == 'add-err') {?>
            <div class="gy-admin-error-message"><?=$this->lang->getMessage('text-err');?></div>
            <br/>
            <a href="/gy/admin/group-user.php" class="gy-admin-button"><?=$this->lang->getMessage('button-text-ok');?></a>
        <?php } ?>
    <?php }?>

<?php }