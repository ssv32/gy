<?
if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

if ($arRes['allUsers']){?>
	<table border="1" class="gy-table-all-users">
		<tr><th>id</th><th>login</th><th>name</th><th>group</th><th></th></tr>
		<?foreach ($arRes['allUsers'] as $key => $val){?>
			<tr>
				<td><?=$val['id'];?></td>
				<td><?=$val['login'];?></td>
				<td><?=$val['name'];?></td>
				<td><?=$val['groups'];?></td>
				<td>
					<?if ($val['id'] != 1){?>
					<button  class="del-user gy-admin-button" data-id-user="<?=$val['id'];?>"><?=$this->lang->GetMessage('del-user');?></button>
					<?} ?>
				</td>
			</tr>
		<?}?>
	</table>
<?}?>