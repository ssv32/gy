<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

?>
<h3><?=$this->lang->GetMessage('title-add');?></h3>
<?php

if (!empty($arParam['back-url'])){?>
    <br/>
    <br/>
    <a class="gy-admin-button" href="<?=$arParam['back-url'];?>"><?=$this->lang->GetMessage('back');?></a>
    <br/>
    <br/>
<?php }?>
<?php if ($arRes["stat"] == 'add') {?>
    <form>
        <?php foreach ($arRes["user_property"] as $key => $val ){?>
            <?=$this->lang->GetMessage($val);?>:<br/>
            <?php if($val != 'groups'){?>
                <input type="<?=(($val == 'pass')? 'password': 'text');?>" name="<?=$val;?>" />
            <?php }else{?>
                <select multiple name="groups[]">
                    <?php foreach ($arRes['allUsersGroups'] as $value) { ?>
                        <option value="<?=$value['code'];?>">
                            <?=$value['name']?> (<?=$value['code'];?>)
                        </option>
                    <?php }?>
                </select>
            <?php }?>
        <br/>
        <?php }?>
    <input class="gy-admin-button" type="submit" name="<?=$this->lang->GetMessage('button');?>" value="<?=$this->lang->GetMessage('button');?>" />

    </form>	
	
<?php }elseif($arRes["stat"] == 'ok'){?>
    <div class="gy-admin-good-message"><?=$this->lang->GetMessage('add-ok');?></div>
    <br/>
    <a href="<?=$arParam['back-url'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<?php }elseif($arRes["stat"] == 'err'){?>
    <div class="gy-admin-error-message"><?=$this->lang->GetMessage('add-err');?></div>
    <?php if (!empty($arRes["stat-text"])){?>
        <br/> <?=$arRes["stat-text"];?>
    <?php }?>
    <br/>
    <a href="<?=$arParam['back-url'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('ok');?></a>
<?php } 
