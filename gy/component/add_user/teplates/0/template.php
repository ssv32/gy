<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );

?>
<h3><?=$this->lang->getMessage('title-add');?></h3>
<?php

if (!empty($arParam['back-url'])){?>
    <br/>
    <br/>
    <a class="gy-admin-button" href="<?=$arParam['back-url'];?>"><?=$this->lang->getMessage('back');?></a>
    <br/>
    <br/>
<?php }?>
<?php if ($arRes["stat"] == 'add') {?>
    <form>
        <?php foreach ($arRes["user_property"] as $key => $val ){?>
            <?=$this->lang->getMessage($val);?>:<br/>
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
    <input class="gy-admin-button" type="submit" name="<?=$this->lang->getMessage('button');?>" value="<?=$this->lang->getMessage('button');?>" />

    </form>	
	
<?php }elseif($arRes["stat"] == 'ok'){?>
    <div class="gy-admin-good-message"><?=$this->lang->getMessage('add-ok');?></div>
    <br/>
    <a href="<?=$arParam['back-url'];?>" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php }elseif($arRes["stat"] == 'err'){?>
    <div class="gy-admin-error-message"><?=$this->lang->getMessage('add-err');?></div>
    <?php if (!empty($arRes["stat-text"])){?>
        <br/> <?=$arRes["stat-text"];?>
    <?php }?>
    <br/>
    <a href="<?=$arParam['back-url'];?>" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php } 
