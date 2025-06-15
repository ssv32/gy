<?php
if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );
?>
<h3><?=$this->lang->getMessage('title-add');?></h3>
<?php

if (!empty($this->model->backUrl)) {?>
    <br/>
    <br/>
    <a class="gy-admin-button" href="<?=$this->model->backUrl;?>"><?=$this->lang->getMessage('back');?></a>
    <br/>
    <br/>
<?php }?>
<?php if ($this->model->stat == 'add') {?>
    <form>
        <?php foreach ($this->model->userProperty as $key => $val) {?>
            <?=$this->lang->getMessage($val);?>:<br/>
            <?php if ($val != 'groups') {?>
                <input type="<?=(($val == 'pass')? 'password': 'text');?>" name="<?=$val;?>" />
            <?php } else {?>
                <select multiple name="groups[]">
                    <?php foreach ($this->model->allUsersGroups as $value) { ?>
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

<?php } elseif ($this->model->stat == 'ok') {?>
    <div class="gy-admin-good-message"><?=$this->lang->getMessage('add-ok');?></div>
    <br/>
    <a href="<?=$this->model->backUrl;?>" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php } elseif ($this->model->stat == 'err') { ?>
    <div class="gy-admin-error-message"><?=$this->lang->getMessage('add-err');?></div>
    <?php if (!empty($this->model->statText)) {?>
        <br/> <?=$this->model->statText;?>
    <?php }?>
    <br/>
    <a href="<?=$this->model->backUrl;?>" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php } 
