<?php if (!defined("GY_CORE") && (GY_CORE !== true)) die( "gy: err include core" );?>
<?php
if ($arParam['show-bread-crumbs'] == 1) {
    global $APP;
    $APP->component(
        'bread-crumbs',
        '0',
        array( 
            'items' => $arParam['bread-crumbs-items']
        )
    );
}?>


<h1><?=$this->lang->getMessage('title');?><?=$arParam['id']?></h1>

<?php if (!empty($arRes['dataUser'])) {?>
    <h3><?=$this->lang->getMessage('title-property-standart');?></h3>
    <table border="1" class="gy-table-all-users">

        <tr>
            <th><?=$this->lang->getMessage('name-property');?></th>
            <th><?=$this->lang->getMessage('value-property');?></th>
        </tr>

        <tr>
            <td>id</td>
            <td><?=$arRes['dataUser']['id']?></td> 
        </tr>    
        <tr>
            <td>login</td>
            <td><?=$arRes['dataUser']['login']?></td> 
        </tr>    
        <tr>
            <td>name</td>
            <td><?=$arRes['dataUser']['name']?></td> 
        </tr>    
        <tr>
            <td>groups</td>
            <td>
                <?php if (!empty($arRes['dataUser']['groups'])) {?>
                    <?php foreach ($arRes['dataUser']['groups'] as $value) { ?>
                        <?=$value?>
                        </br>
                    <?php }?>
                <?php } else {?>
                    -
                <?php }?>
            </td> 
        </tr>    


    </table>

    <?php if (!empty($arRes['dataUser']['propertys'])) {?>
        <h3><?=$this->lang->getMessage('title-property');?></h3>

        <table border="1" class="gy-table-all-users">

            <tr>
                <th><?=$this->lang->getMessage('name-property');?></th>
                <th><?=$this->lang->getMessage('value-property');?></th>
            </tr>

            <?php foreach ($arRes['dataUser']['propertys'] as $value) { ?>
                <tr>
                    <td><?=$value['name_property']?></td>
                    <td>
                        <?=$value['value']?>
                    </td> 
                </tr>    
            <?php }?>

        </table>
    <?php }?>
<?php } else {?>
    <?=$this->lang->getMessage('err-data');?>
<?php }?>

