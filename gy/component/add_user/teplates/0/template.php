<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

if (!empty($arParam['back-url'])){?>
    <br/>
    <br/>
	<a class="gy-admin-button" href="<?=$arParam['back-url'];?>"><< Назад</a>
	<br/>
	<br/>
<?}?>
<? if ($arRes["stat"] == 'add') {?>
	<form>
		<? foreach ($arRes["user_property"] as $key => $val ){?>
			<?=$this->lang->GetMessage($val);?>:<br/>
			<input type="<?=(($val == 'pass')? 'password': 'text');?>" name="<?=$val;?>" />
			<br/>
		<?}?>
		<input class="gy-admin-button" type="submit" name="<?=$this->lang->GetMessage('button');?>" value="<?=$this->lang->GetMessage('button');?>" />

	</form>	
	
<?}elseif($arRes["stat"] == 'ok'){?>
    <div class="gy-admin-good-message">ok add user</div>
<?}elseif($arRes["stat"] == 'err'){?>
    <div class="gy-admin-error-message">error, попробуйте заново</div>
	<?if (!empty($arRes["stat-text"])){?>
		<br/> <?=$arRes["stat-text"];?>
	<?}?>
<? } ?>
