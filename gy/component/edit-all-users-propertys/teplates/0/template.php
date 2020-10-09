<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );?>

<h1><?=$this->lang->getMessage('title');?></h1>

<?php if (!empty($arRes['stat'])) {?>
    <?php if ($arRes['stat'] == 'ok') { ?>
        <div class="gy-admin-good-message"><?=$this->lang->getMessage('stat-ok');?></div>
        <br/>
    <?php }?>

    <?php if ($arRes['stat'] == 'err') {?>
        <div class="gy-admin-error-message"><?=$this->lang->getMessage('stat-err');?></div>
        <br/>
    <?php }?>
    <a href="edit-all-users-propertys.php" class="gy-admin-button"><?=$this->lang->getMessage('ok');?></a>
<?php } else {?>

    <?php if ($arRes['allUsersCreatePropertys']) {?>
        <table border="1" class="gy-table-all-users">
            <tr>
                <th>id</th>
                <th><?=$this->lang->getMessage('name');?></th>
                <th><?=$this->lang->getMessage('type');?></th>
                <th><?=$this->lang->getMessage('code');?></th>
                <th></th>
            </tr>

                <?php foreach ($arRes['allUsersCreatePropertys'] as $key => $val) {?>
                    <tr>
                        <td><?=$val['id'];?></td>
                        <td><?=$val['name_property'];?></td>
                        <td><?=$val['type_property'];?></td>
                        <td><?=$val['code'];?></td>

                        <td>  
                            <br/>
                            <a href="?del-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->getMessage('del-property');?></a>
                            <br/>
                            <br/>
                        </td>
                    </tr>
                <?php }?>

        </table>
    <?php } else {?>
        <?=$this->lang->getMessage('not-propertys');?>
    <?php }?>
    
    <br/>
    <br/>
    
    <?php if (!empty($arRes['allTypePropertys'])) {?>
    
        <h3><?=$this->lang->getMessage('title-add-property');?></h3>
    
        <form method="post" >
            
            <table border="1" class="gy-table-all-users">

                <tr>
                    <td><?=$this->lang->getMessage('name');?></td>
                    <td><input type="text" name="name_property" ></td> 
                </tr>
                
                <tr>
                    <td><?=$this->lang->getMessage('type');?></td>
                    <td>
                        <select name="type_property">
                            <?php foreach ($arRes['allTypePropertys'] as $value) { ?>
                                <option value="<?=$value['id']?>"><?=$value['name_type']?> - <?=$value['info']?></option> 
                            <?php }?>  
                        </select>
                    </td>
                </tr>
            
                <tr>
                    <td><?=$this->lang->getMessage('code');?></td>
                    <td><input type="text"  name="code" ></td>
                </tr>
            </table>
            <input type="submit" class="gy-admin-button" value="<?=$this->lang->getMessage('add-property');?>" />
        </form>
    <?php }?>
<?php }?>
        