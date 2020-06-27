<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );
?>
<h2><?=$this->lang->GetMessage($arRes['h1']);?></h2>
<?if ($arRes['info-modules']){?>

    <table border="1" class="gy-table-all-users">
        <tr><th>Имя модуля</th><th>Версия</th></tr>

        <?foreach ($arRes['info-modules'] as $key => $val){?>
            <tr>
                <td><?=$key;?></td>
                <td><?=$val;?></td>
            </tr>
        <?}?>     
    </table>
<?}