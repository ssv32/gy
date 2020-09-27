<?php
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );
?>
<h2><?=$this->lang->getMessage($arRes['h1']);?></h2>
<?php if ($arRes['info-modules']){?>

    <table border="1" class="gy-table-all-users">
        <tr><th><?=$this->lang->getMessage('name')?></th><th><?=$this->lang->getMessage('v')?></th></tr>

        <?php foreach ($arRes['info-modules'] as $key => $val){?>
            <tr>
                <td><?=$key;?></td>
                <td><?=$val;?></td>
            </tr>
        <?php }?>     
    </table>
<?php }