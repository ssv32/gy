<? // шаблон компонента // template component form_auth
if ( empty($arRes["auth_ok"]) ) :?>
	<form>
		<? 
		foreach ($arRes as $key => $value) {
		?>
		<input type="hidden" name="idComponent" value="<?=$arParam['idComponent']?>" />
			<input type="text" name="<?=$key;?>"  />
		<?}?>

		<input type="submit" name="<?=$this->lang->GetMessage('button');?>" value="<?=$this->lang->GetMessage('button');?>" />

	</form>	
<?else:?>
	<h1>Привет, <?=$arRes["auth_user"];?></h1>

<?endif;?>