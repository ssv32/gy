<?if (!empty($arParam['back-url'])){?>
	<a href="<?=$arParam['back-url'];?>"><< Назад</a>
	<br/>
<?}?>
<? if ($arRes["stat"] == 'add') {?>
	<form>
		<? foreach ($arRes["user_property"] as $key => $val ){?>
			<?=$this->lang->GetMessage($val);?>:<br/>
			<input type="<?=(($val == 'pass')? 'password': 'text');?>" name="<?=$val;?>" />
			<br/>
		<?}?>
		<input type="submit" name="<?=$this->lang->GetMessage('button');?>" value="<?=$this->lang->GetMessage('button');?>" />

	</form>	
	
<?}elseif($arRes["stat"] == 'ok'){?>
	ok add user
<?}elseif($arRes["stat"] == 'err'){?>
	error, попробуйте заново
	<?if (!empty($arRes["stat-text"])){?>
		<br/> <?=$arRes["stat-text"];?>
	<?}?>
<? } ?>
