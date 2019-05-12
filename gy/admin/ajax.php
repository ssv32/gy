<?
include "../../gy/gy.php"; // подключить ядро // include core

if ( !defined("GY_GLOBAL_FLAG_CORE_INCLUDE") && (GY_GLOBAL_FLAG_CORE_INCLUDE !== true) ) die( "gy: err include core" );

$result = array(
	'stat' => 'err'
);

$data = $_REQUEST;

global $user;

if ($user->isAdmin() && !empty($data['action'])){
	// действие удалить пользователя
	if (($data['action'] == 'user-del') && !empty($data['id-user'])  ) {
				
		$res = $user->deleteUserById($data['id-user']);
		if ($res){
			$result['stat'] = 'ok';
		}
	}
}

echo json_encode($result);

?>