<? // шаблон компонента // template component form_auth_test
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

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