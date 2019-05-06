<?
if ($arParam['buttons']){?>
	<div class="menu">
		<? foreach ($arParam['buttons'] as $key => $val){?>
			<a href="<?=$val;?>" class="<?=(($val == $arRes['thisUrl'])? 'active-menu': '');?>"><?=$key;?></a>
		<?}?>
	</div>
<?}?>