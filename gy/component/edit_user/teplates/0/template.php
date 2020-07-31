<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

?>
<h3><?=$this->lang->GetMessage('title');?></h3>
<?
if (!empty($arParam['back-url']) && empty($arRes["stat"])){?>
    <br/>
    <br/>
    <a class="gy-admin-button" href="<?=$arParam['back-url'];?>"><?=$this->lang->GetMessage('back');?></a>
    <br/>
    <br/>
<?}?>
<? if (empty($arRes["stat"]) || ($arRes["stat"] == 'edit') ) {?>
    <form>
    <input type="hidden" name="edit-id" value="<?=$arParam['id-user'];?>" />
        <? foreach ($arRes["user_property"] as $key => $val ){?>
            <?=$this->lang->GetMessage($val);?>:<br/>
            <?if ($val != 'groups'){?>
                <input 
                    type="<?=(($val == 'pass')? 'password': 'text');?>" 
                    name="<?=$val;?>" 
                    value="<?=((!empty($arRes['userData'][$val]))? $arRes['userData'][$val] : '');?>"
                />
                <?
                // эта галочка что бы можно было менять настройки пользователя, без смены пароля
                if($val == 'pass'){?>
                    <input type="checkbox" name="no-update-pass" /><?=$this->lang->GetMessage('no-update-pass-text');?> 
                <?}?>
            <?}else{?>
                <select multiple name="groups[]">
                    <? foreach ($arRes['allUsersGroups'] as $value) { ?>
                        <option <?=(( !empty($arRes['userData'][$val][$value['code']]) )? 'selected' : '');?> value="<?=$value['code'];?>">
                            <?=$value['name']?> (<?=$value['code'];?>)
                        </option>
                    <?}?>
                </select>
            <?}?>    
            <br/>
        <?}?>
        <input class="gy-admin-button" type="submit" name="<?=$this->lang->GetMessage('button');?>" value="<?=$this->lang->GetMessage('button');?>" />

    </form>	
	
<?}elseif($arRes["stat"] == 'ok'){?>
    <div class="gy-admin-good-message"><?=$this->lang->GetMessage('stat-ok');?></div>
    <br/>
    <a href="/gy/admin/users.php" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<?}elseif($arRes["stat"] == 'err'){?>
    <div class="gy-admin-error-message"><?=$this->lang->GetMessage('edit-err');?></div>
    <?if (!empty($arRes["stat-text"])){?>
        <br/> <?=$arRes["stat-text"];?>
    <?}?>
    <br/>
    <a href="edit-user.php?edit-id=<?=$arParam['id-user'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<? } 
