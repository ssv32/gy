<?
include "../../gy/gy.php"; // подключить ядро // include core

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