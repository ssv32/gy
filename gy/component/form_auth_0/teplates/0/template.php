<? // шаблон компонента // template component form_auth
if ( empty($arRes["auth_ok"]) ) :?>
	<form>
		<input type="hidden" name="idComponent" value="<?=$arParam['idComponent']?>" />

		<?foreach ($arRes['form_input'] as $key => $value) { ?>
			<input type="<?=(($key == 'pass')? 'password': 'text');?>" name="<?=$key;?>"  /><br/>
		<?}?>

		<?if ( !empty($arRes['err']) ){?>
			<h4><?=$this->lang->GetMessage($arRes['err']);?></h4>
		<?}?>	
		<input type="submit" name="<?=$this->lang->GetMessage('button');?>" value="<?=$this->lang->GetMessage('button');?>" />

	</form>	
<?else:?>
	<h1>Привет, <?=$arRes["auth_user"];?></h1>
	<form>
		<input type="submit" name="<?=$this->lang->GetMessage('exit');?>" value="<?=$this->lang->GetMessage('exit');?>" />
	</form>
<?endif;?>