<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

if ($arParam['buttons']){?>
	<div class="gy-admin-menu">
		<? foreach ($arParam['buttons'] as $key => $val){?>
			<a href="<?=$val;?>" class="<?=(($val == $arRes['thisUrl'])? 'active-menu': '');?>"><?=$key;?></a>
		<?}?>
	</div>
<?}?>