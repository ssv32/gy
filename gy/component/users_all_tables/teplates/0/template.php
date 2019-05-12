<?if ($arRes['allUsers']){?>
	<table border="1" class="gy-table-all-users">
		<tr><td>id</td><td>login</td><td>name</td><td>group</td><td></td></tr>
		<?foreach ($arRes['allUsers'] as $key => $val){?>
			<tr>
				<td><?=$val['id'];?></td>
				<td><?=$val['login'];?></td>
				<td><?=$val['name'];?></td>
				<td><?=$val['groups'];?></td>
				<td>
					<?if ($val['id'] != 1){?>
					<button class="del-user" data-id-user="<?=$val['id'];?>"><?=$this->lang->GetMessage('del-user');?></button>
					<?} ?>
				</td>
			</tr>
		<?}?>
	</table>
<?}?>