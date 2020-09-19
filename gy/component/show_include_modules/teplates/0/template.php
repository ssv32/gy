<?
if ( !defined("GY_CORE") && (GY_CORE !== true) ) die( "gy: err include core" );
?>
<h2><?=$this->lang->GetMessage($arRes['h1']);?></h2>
<?if ($arRes['info-modules']){?>

    <table border="1" class="gy-table-all-users">
        <tr><th><?=$this->lang->GetMessage('name')?></th><th><?=$this->lang->GetMessage('v')?></th></tr>

        <?foreach ($arRes['info-modules'] as $key => $val){?>
            <tr>
                <td><?=$key;?></td>
                <td><?=$val;?></td>
            </tr>
        <?}?>     
    </table>
<?}