<? // TODO сделать нормальнопо шагам потом
include "../../gy/gy.php"; // подключить ядро // include core

if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

echo 'install table - user ...';

global $db;
        
//$db->connect($db_config['db_host'], $db_config['db_user'], $db_config['db_pass'], $db_config['db_name']);
$res = $db->query($db->db, 'CREATE TABLE users (id int PRIMARY KEY AUTO_INCREMENT, login varchar(50), name varchar(50), pass varchar(50), hash_auth varchar(50), groups int );');
//$db->close($db->db);

if ($res === true){
	echo '<br/>install table - user - OK';
	
	echo '<br/>add admin ...';

	global $crypto;
	//$db->connect($db_config['db_host'], $db_config['db_user'], $db_config['db_pass'], $db_config['db_name']);
	$res = $db->query($db->db, "INSERT INTO users (id, login, name, pass, groups ) VALUES(1, 'admin', 'admin', '".md5('admin'.$crypto->getSole())."', 1 )");
	$res = $db->query($db->db, "INSERT INTO users (id, login, name, pass, groups ) VALUES(2, 'asd', 'asd', '".md5('asdasd'.$crypto->getSole())."', 2 )");
	//$db->close($db->db);
	
	var_dump($res);
	print_r($res);
	
	if($res === true){
		echo '<br/>add admin - OK';
	}else{
		echo '<br/>add admin - NOT!';
	}
	
}else{
	echo '<br/>install table - user - NOT!';
}



?>