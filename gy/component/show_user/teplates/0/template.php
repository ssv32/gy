<?if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );?>
<h1><?=$this->lang->GetMessage('title');?><?=$arParam['id']?></h1>

<?if(!empty($arRes['dataUser'])){?>
    <h3><?=$this->lang->GetMessage('title-property-standart');?></h3>
    <table border="1" class="gy-table-all-users">

        <tr>
            <th><?=$this->lang->GetMessage('name-property');?></th>
            <th><?=$this->lang->GetMessage('value-property');?></th>
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
                <?if(!empty($arRes['dataUser']['groups'])){?>
                    <? foreach ($arRes['dataUser']['groups'] as $value) { ?>
                        <?=$value?>
                        </br>
                    <?}?>
                <?}else{?>
                    -
                <?}?>
            </td> 
        </tr>    


    </table>

    <?if(!empty($arRes['dataUser']['propertys'])){?>
        <h3><?=$this->lang->GetMessage('title-property');?></h3>

        <table border="1" class="gy-table-all-users">

            <tr>
                <th><?=$this->lang->GetMessage('name-property');?></th>
                <th><?=$this->lang->GetMessage('value-property');?></th>
            </tr>

            <? foreach ($arRes['dataUser']['propertys'] as $value) { ?>
                <tr>
                    <td><?=$value['name_property']?></td>
                    <td>
                        <?=$value['value']?>
                    </td> 
                </tr>    
            <?}?>

        </table>
    <?}?>
<?}else{?>
    <?=$this->lang->GetMessage('err-data');?>
<?}?>
