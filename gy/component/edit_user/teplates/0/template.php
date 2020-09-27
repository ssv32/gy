<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

?>
<h3><?=$this->lang->getMessage('title');?></h3>
<?php
if (!empty($arParam['back-url']) && empty($arRes["stat"])){?>
    <br/>
    <br/>
    <a class="gy-admin-button" href="<?=$arParam['back-url'];?>"><?=$this->lang->getMessage('back');?></a>
    <br/>
    <br/>
<?php }?>
<?php if (empty($arRes["stat"]) || ($arRes["stat"] == 'edit') ) {?>
    <form>
        <input type="hidden" name="edit-id" value="<?=$arParam['id-user'];?>" />
        <?php foreach ($arRes["user_property"] as $key => $val ){?>
            <?=$this->lang->getMessage($val);?>:<br/>
            <?php if ($val != 'groups'){?>
                <input 
                    type="<?=(($val == 'pass')? 'password': 'text');?>" 
                    name="<?=$val;?>" 
                    value="<?=((!empty($arRes['userData'][$val]))? $arRes['userData'][$val] : '');?>"
                />
                <?php
                // эта галочка что бы можно было менять настройки пользователя, без смены пароля
                if($val == 'pass'){?>
                    <input type="checkbox" name="no-update-pass" /><?=$this->lang->getMessage('no-update-pass-text');?> 
                <?php }?>
            <?php }else{?>
                <select multiple name="groups[]">
                    <?php foreach ($arRes['allUsersGroups'] as $value) { ?>
                        <option <?=(( !empty($arRes['userData'][$val][$value['code']]) )? 'selected' : '');?> value="<?=$value['code'];?>">
                            <?=$value['name']?> (<?=$value['code'];?>)
                        </option>
                    <?php }?>
                </select>
            <?php }?>    
            <br/>
        <?php }?>
        <input class="gy-admin-button" type="submit" name="<?=$this->lang->getMessage('button');?>" value="<?=$this->lang->getMessage('button');?>" />

    </form>	
    
    <br/>
    <a class="gy-admin-button" href="/gy/admin/edit-users-propertys.php?edit-id=<?=$arParam['id-user'];?>"><?=$this->lang->getMessage('edit-propertys');?></a>
    
<?php }elseif($arRes["stat"] == 'ok'){?>
    <div class="gy-admin-good-message"><?=$this->lang->getMessage('stat-ok');?></div>
    <br/>
    <a href="/gy/admin/users.php" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php }elseif($arRes["stat"] == 'err'){?>
    <div class="gy-admin-error-message"><?=$this->lang->getMessage('edit-err');?></div>
    <?php if (!empty($arRes["stat-text"])){?>
        <br/> <?=$arRes["stat-text"];?>
    <?php }?>
    <br/>
    <a href="edit-user.php?edit-id=<?=$arParam['id-user'];?>" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php } 
