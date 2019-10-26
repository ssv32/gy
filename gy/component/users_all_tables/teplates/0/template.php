<?if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );?>

<h1><?=$this->lang->GetMessage('title');?></h1>

<?if ($arRes['allUsers']){?>
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
                        <a href="edit-user.php?edit-id=<?=$val['id'];?>" class="gy-admin-button"><?=$this->lang->GetMessage('edit-user');?></a>
                    <?} ?>
				</td>
			</tr>
		<?}?>
	</table>

    	
    <br/>
    <br/>
	<a class="gy-admin-button" href="add-user.php"><?=$this->lang->GetMessage('add-user');?></a>
	<br/>
	<br/>
<?}?>