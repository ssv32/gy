<? // TODO сделать нормальнопо шагам потом
include "../../gy/gy.php"; // подключить ядро // include core

echo 'install table - user ...';

global $db;
        
$res = $db->query('CREATE TABLE users (id int PRIMARY KEY AUTO_INCREMENT, login varchar(50), name varchar(50), pass varchar(50), hash_auth varchar(50), groups int );');

if ($res === true){
	echo '<br/>install table - user - OK';
	
	echo '<br/>add admin ...';
    
    $res = $db->insertDb(
        'users', 
        array(
            'login' => 'admin', 
            'name' => 'admin', 
            'pass' =>   'admin', 
            'groups' => 1
        )
    );

    $res = $db->insertDb(
        'users', 
        array(
            'login' => 'asd', 
            'name' => 'asd', 
            'pass' =>  'asdasd', 
            'groups' => 2
        )
    );
    	
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

